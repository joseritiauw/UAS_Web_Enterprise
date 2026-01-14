<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/jurnal', [DashboardController::class, 'jurnal'])->name('jurnal');
    Route::get('/report', [DashboardController::class, 'report'])->name('report');
    Route::get('/database-user', [DashboardController::class, 'databaseUser'])->name('database.user');
    Route::get('/update-data', [DashboardController::class, 'updateData'])->name('update.data');
    Route::post('/update-data', [DashboardController::class, 'updateDataPost'])->name('update.data.post');
    Route::get('/reset-password-user', [DashboardController::class, 'resetPasswordUser'])->name('reset.password');
    Route::post('/reset-password-user', [DashboardController::class, 'resetPasswordUserPost'])->name('reset.password.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
