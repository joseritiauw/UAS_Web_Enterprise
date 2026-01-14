<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle CSRF token mismatch
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi Anda telah berakhir. Silakan refresh halaman dan coba lagi.'
                ], 419);
            }

            return redirect()->route('login')
                ->withErrors(['error' => 'Sesi Anda telah berakhir. Silakan coba lagi.'])
                ->withInput($request->except('password'));
        });
    })->create();
