<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\Token;

class CheckTokenExpiry
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            // Get current token
            $token = $user->token();

            if ($token) {
                // Check if token is expired
                if ($token->expires_at && now()->greaterThan($token->expires_at)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Token telah kadaluarsa. Silakan login kembali.',
                        'token_expired' => true,
                        'expired_at' => $token->expires_at->toDateTimeString()
                    ], 401);
                }

                // Optional: Check if token will expire soon (within 5 minutes)
                if ($token->expires_at && now()->diffInMinutes($token->expires_at) <= 5) {
                    // Add header to indicate token will expire soon
                    $response = $next($request);
                    $response->headers->set('X-Token-Expires-Soon', 'true');
                    $response->headers->set('X-Token-Expires-At', $token->expires_at->toDateTimeString());
                    return $response;
                }
            }
        }

        return $next($request);
    }
}
