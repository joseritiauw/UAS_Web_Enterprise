<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Token;

class TokenController extends Controller
{
    /**
     * Check if current token is expired or about to expire
     */
    public function checkTokenExpiry(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak terautentikasi',
                'is_expired' => true
            ], 401);
        }

        $token = $user->token();

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak ditemukan',
                'is_expired' => true
            ], 401);
        }

        $expiresAt = $token->expires_at;
        $now = now();

        $isExpired = $expiresAt && $now->greaterThan($expiresAt);
        $minutesRemaining = $expiresAt ? $now->diffInMinutes($expiresAt, false) : null;
        $willExpireSoon = $minutesRemaining !== null && $minutesRemaining <= 5 && $minutesRemaining > 0;

        return response()->json([
            'success' => true,
            'token_info' => [
                'is_expired' => $isExpired,
                'will_expire_soon' => $willExpireSoon,
                'expires_at' => $expiresAt ? $expiresAt->toDateTimeString() : null,
                'minutes_remaining' => $minutesRemaining,
                'created_at' => $token->created_at->toDateTimeString(),
            ]
        ]);
    }

    /**
     * Refresh token before it expires
     */
    public function refreshToken(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak terautentikasi'
            ], 401);
        }

        // Revoke old token
        $oldToken = $user->token();
        if ($oldToken) {
            $oldToken->revoke();
        }

        // Create new token with 30 minutes expiry
        $newToken = $user->createToken('access_token')->accessToken;

        return response()->json([
            'success' => true,
            'message' => 'Token berhasil diperbarui',
            'token' => $newToken,
            'expires_in_minutes' => 30
        ]);
    }

    /**
     * Revoke all user tokens (logout from all devices)
     */
    public function revokeAllTokens(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak terautentikasi'
            ], 401);
        }

        // Revoke all tokens
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Semua token telah dibatalkan'
        ]);
    }

    /**
     * Get all user tokens with expiry info from oauth_access_tokens table
     */
    public function getAllUserTokens(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak terautentikasi'
            ], 401);
        }

        // Get all tokens from oauth_access_tokens table
        $tokens = \DB::table('oauth_access_tokens')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($token) {
                $expiresAt = \Carbon\Carbon::parse($token->expires_at);
                $now = now();

                return [
                    'id' => $token->id,
                    'revoked' => (bool) $token->revoked,
                    'expires_at' => $expiresAt->toDateTimeString(),
                    'created_at' => \Carbon\Carbon::parse($token->created_at)->toDateTimeString(),
                    'is_expired' => $now->greaterThan($expiresAt),
                    'minutes_remaining' => $now->diffInMinutes($expiresAt, false),
                    'is_current' => $token->id === $user->token()->id ?? null,
                ];
            });

        return response()->json([
            'success' => true,
            'user_id' => $user->id,
            'email' => $user->email,
            'total_tokens' => $tokens->count(),
            'tokens' => $tokens
        ]);
    }
}
