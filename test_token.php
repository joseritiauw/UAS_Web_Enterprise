<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Get user
$user = \App\Models\User::where('email', 'jose@gmail.com')->first();

if (!$user) {
    echo "User tidak ditemukan!\n";
    exit;
}

echo "=== JWT TOKEN TEST ===\n\n";
echo "User: {$user->email} (ID: {$user->id})\n\n";

// Create new token
echo "Creating new token...\n";
$tokenResponse = $user->createToken('TestToken');
$accessToken = $tokenResponse->accessToken;
$tokenObject = $tokenResponse->token;

echo "\n--- TOKEN INFO ---\n";
echo "Access Token: " . substr($accessToken, 0, 50) . "...\n";
echo "Token ID: {$tokenObject->id}\n";
echo "Created At: {$tokenObject->created_at}\n";
echo "Expires At: {$tokenObject->expires_at}\n";
echo "Revoked: " . ($tokenObject->revoked ? 'YES' : 'NO') . "\n";

// Calculate minutes remaining
$now = now();
$expiresAt = $tokenObject->expires_at;
$minutesRemaining = $now->diffInMinutes($expiresAt, false);
$isExpired = $now->greaterThan($expiresAt);

echo "\n--- EXPIRY CHECK ---\n";
echo "Current Time: {$now}\n";
echo "Is Expired: " . ($isExpired ? 'YES ❌' : 'NO ✅') . "\n";
echo "Minutes Until Expire: {$minutesRemaining} menit\n";

if ($minutesRemaining > 0) {
    echo "Status: Token masih valid untuk {$minutesRemaining} menit lagi\n";
} else {
    echo "Status: Token sudah expired sejak " . abs($minutesRemaining) . " menit yang lalu\n";
}

// Check all user tokens
echo "\n--- ALL USER TOKENS ---\n";
$allTokens = \DB::table('oauth_access_tokens')
    ->where('user_id', $user->id)
    ->orderBy('created_at', 'desc')
    ->limit(5)
    ->get();

foreach ($allTokens as $t) {
    $tExpiresAt = \Carbon\Carbon::parse($t->expires_at);
    $tMinutes = now()->diffInMinutes($tExpiresAt, false);
    $tExpired = now()->greaterThan($tExpiresAt);

    echo "\nToken ID: {$t->id}\n";
    echo "  Created: {$t->created_at}\n";
    echo "  Expires: {$t->expires_at}\n";
    echo "  Status: " . ($tExpired ? "EXPIRED ❌" : "VALID ✅ ({$tMinutes} menit)") . "\n";
    echo "  Revoked: " . ($t->revoked ? 'YES' : 'NO') . "\n";
}

echo "\n=== TEST COMPLETE ===\n";
echo "\nKonfigurasi JWT:\n";
echo "- Algorithm: RS256 (RSA + SHA-256)\n";
echo "- Token Expires: 30 menit\n";
echo "- Refresh Token Expires: 30 hari\n";
