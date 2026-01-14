<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle login request with validation
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'username/password incorrect',
            'email.email' => 'username/password incorrect',
            'password.required' => 'username/password incorrect',
            'password.min' => 'username/password incorrect',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'username/password incorrect'
                ], 422);
            }
            return back()->withErrors(['error' => 'username/password incorrect'])->withInput();
        }

        $email = $request->email;

        // Validate domain - reject @ganteng.com
        if (str_ends_with($email, '@ganteng.com')) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'username/password incorrect'
                ], 422);
            }
            return back()->withErrors(['error' => 'username/password incorrect'])->withInput();
        }

        // Find user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'username/password incorrect'
                ], 422);
            }
            return back()->withErrors(['error' => 'username/password incorrect'])->withInput();
        }

        // Verify password
        if (!Hash::check($request->password, $user->hashed_password)) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'username/password incorrect'
                ], 422);
            }
            return back()->withErrors(['error' => 'username/password incorrect'])->withInput();
        }

        // Login user
        auth()->login($user);

        // Create access token
        $token = $user->createToken('access_token')->accessToken;

        // Return JSON response for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => route('dashboard'),
                'token' => $token
            ]);
        }

        // Redirect to dashboard for regular requests
        return redirect()->route('dashboard')->with('token', $token);
    }

    /**
     * Handle register request with validation
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'username/password incorrect',
            'email.email' => 'username/password incorrect',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'username/password incorrect',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'username/password incorrect'
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;

        // Validate domain - reject @ganteng.com
        if (str_ends_with($email, '@ganteng.com')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'username/password incorrect'
                ], 422);
            }
            return back()->withErrors(['email' => 'username/password incorrect'])->withInput();
        }

        // Create user
        $user = User::create([
            'email' => $email,
            'hashed_password' => Hash::make($request->password),
        ]);

        // Return JSON response for AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dibuat! Silakan login dengan akun Anda.'
            ]);
        }

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login dengan akun Anda.');
    }

    /**
     * Handle forgot password request - send email with reset link
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email Anda Salah',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }
            return back()->withErrors(['error' => $validator->errors()->first()])->withInput();
        }

        $email = $request->email;

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email Anda Salah'
                ], 422);
            }
            return back()->withErrors(['error' => 'Email Anda Salah'])->withInput();
        }

        // Find user
        $user = User::where('email', $email)->first();

        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email Anda Salah'
                ], 404);
            }
            return back()->withErrors(['error' => 'Email Anda Salah'])->withInput();
        }

        // Generate reset token and OTP
        $resetToken = Str::random(60);
        $otp = rand(100000, 999999); // Generate 6-digit OTP

        // Save reset token and OTP to user with expiry (15 minutes)
        $user->reset_token = $resetToken;
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        // Send email with OTP
        try {
            // Cek apakah email configuration sudah diset
            $mailConfigured = config('mail.mailers.smtp.username') !== 'your_email@gmail.com'
                && config('mail.mailers.smtp.username') !== null;

            if ($mailConfigured) {
                // Kirim email jika sudah dikonfigurasi
                Mail::send('emails.forgot-password', [
                    'otp' => $otp,
                    'resetToken' => $resetToken,
                    'email' => $email
                ], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Reset Password - Sleepy Panda');
                });

                // Check if there were any failures
                if (count(Mail::failures()) > 0) {
                    throw new \Exception('Gagal mengirim email. Periksa konfigurasi SMTP.');
                }

                \Log::info('Password Reset Email Sent', [
                    'email' => $email,
                    'otp' => $otp
                ]);
            } else {
                // Development mode - log OTP dan token
                \Log::info('Password Reset Request (Development Mode)', [
                    'email' => $email,
                    'otp' => $otp,
                    'token' => $resetToken,
                    'message' => 'Email belum dikonfigurasi. Set MAIL_USERNAME dan MAIL_PASSWORD di .env'
                ]);
            }

            $successMessage = $mailConfigured
                ? 'Kode OTP telah dikirim ke email Anda. Silakan cek email dan gunakan kode OTP untuk reset password.'
                : 'Mode Development: OTP telah di-generate. Cek log untuk melihat kode OTP.';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMessage,
                    'dev_mode' => !$mailConfigured,
                    'dev_otp' => !$mailConfigured ? $otp : null
                ]);
            }

            return back()->with('success', $successMessage);
        } catch (\Exception $e) {
            // Log the actual error for debugging
            \Log::error('Forgot Password Email Error: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengirim email: ' . $e->getMessage()
                ], 500);
            }
            return back()->withErrors(['error' => 'Gagal mengirim email. Silakan coba lagi.'])->withInput();
        }
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        if (!$token || !$email) {
            return redirect()->route('login')->withErrors(['error' => 'Link reset password tidak valid']);
        }

        return view('auth.reset-password', compact('token', 'email'));
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . $validator->errors()->first()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Find user by email and token
        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->first();

        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token reset password tidak valid atau sudah digunakan'
                ], 404);
            }
            return back()->withErrors(['error' => 'Token reset password tidak valid']);
        }

        // Update password and clear reset token
        $user->hashed_password = Hash::make($request->password);
        $user->reset_token = null;
        $user->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Password Anda telah berhasil direset. Silakan login dengan password baru Anda.'
            ]);
        }

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Logout user
        auth()->logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Anda telah berhasil logout');
    }
}
