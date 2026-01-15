# JWT Token System Documentation

## JWT Configuration

### Hash Algorithm: RS256 (RSA with SHA-256)
- Menggunakan Laravel Passport
- **Passport default menggunakan RS256** (RSA Signature with SHA-256)
- Token expires: **30 menit**
- Refresh token expires: 30 hari
- Personal access token expires: 6 bulan

**Note:** Laravel Passport secara otomatis menggunakan RS256 algorithm untuk signing JWT tokens. Ini adalah kombinasi dari RSA asymmetric encryption dengan SHA-256 hashing.

## Cara Mengecek Token Expired

### 1. Manual Check via API
```javascript
// Cek status token
fetch('/api/token/check', {
    headers: {
        'Authorization': 'Bearer ' + token
    }
})
.then(response => response.json())
.then(data => {
    if (data.token_info.is_expired) {
        console.log('Token sudah expired!');
        // Redirect ke login
        window.location.href = '/login';
    } else if (data.token_info.will_expire_soon) {
        console.log(`Token akan expired dalam ${data.token_info.minutes_remaining} menit`);
        // Optional: refresh token otomatis
    } else {
        console.log(`Token masih valid. Sisa waktu: ${data.token_info.minutes_remaining} menit`);
    }
});
```

### 2. Automatic Check dengan Middleware
```php
// Tambahkan middleware di route
Route::middleware(['auth', 'check.token.expiry'])->group(function () {
    // Protected routes
});
```

### 3. Response saat Token Expired
```json
{
    "success": false,
    "message": "Token telah kadaluarsa. Silakan login kembali.",
    "token_expired": true,
    "expired_at": "2026-01-15 10:30:00"
}
```

## API Endpoints

### Check Token Status
**GET** `/api/token/check`
- Headers: `Authorization: Bearer {token}`
- Response:
```json
{
    "success": true,
    "token_info": {
        "is_expired": false,
        "will_expire_soon": false,
        "expires_at": "2026-01-15 11:00:00",
        "minutes_remaining": 25,
        "created_at": "2026-01-15 10:30:00"
    }
}
```

### Refresh Token
**POST** `/api/token/refresh`
- Headers: `Authorization: Bearer {token}`
- Response:
```json
{
    "success": true,
    "message": "Token berhasil diperbarui",
    "token": "new_token_here",
    "expires_in_minutes": 30
}
```

### Revoke All Tokens (Logout dari semua device)
**POST** `/api/token/revoke-all`
- Headers: `Authorization: Bearer {token}`
- Response:
```json
{
    "success": true,
    "message": "Semua token telah dibatalkan"
}
```

## Frontend Implementation Example

### Auto Check Token Expiry
```javascript
// Tambahkan di layout utama
setInterval(async function() {
    const token = localStorage.getItem('access_token');
    if (!token) return;
    
    try {
        const response = await fetch('/api/token/check', {
            headers: {
                'Authorization': 'Bearer ' + token
            }
        });
        
        const data = await response.json();
        
        if (data.token_info.is_expired) {
            alert('Sesi Anda telah berakhir. Silakan login kembali.');
            localStorage.removeItem('access_token');
            window.location.href = '/login';
        } else if (data.token_info.will_expire_soon) {
            // Optional: Show notification
            console.warn('Token akan expired dalam ' + data.token_info.minutes_remaining + ' menit');
            
            // Optional: Auto refresh
            const refreshResponse = await fetch('/api/token/refresh', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });
            
            const refreshData = await refreshResponse.json();
            if (refreshData.success) {
                localStorage.setItem('access_token', refreshData.token);
                console.log('Token berhasil di-refresh');
            }
        }
    } catch (error) {
        console.error('Error checking token:', error);
    }
}, 60000); // Check setiap 1 menit
```

## Testing

### Test Token Expiry
```bash
# 1. Login dan dapatkan token
curl -X POST http://localhost:8000/login \
  -d "email=test@example.com" \
  -d "password=password123"

# 2. Cek status token
curl http://localhost:8000/api/token/check \
  -H "Authorization: Bearer YOUR_TOKEN"

# 3. Tunggu 30 menit atau ubah waktu sistem
# 4. Cek lagi - akan return expired

# 5. Test refresh token
curl -X POST http://localhost:8000/api/token/refresh \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## Database Schema
Token disimpan di tabel `oauth_access_tokens`:
- `id`: Token ID
- `user_id`: User ID
- `expires_at`: Waktu token expired (30 menit dari created_at)
- `created_at`: Waktu token dibuat
- `revoked`: Status token (0 = valid, 1 = revoked)

## Security Features
✅ SHA-256 hash algorithm
✅ 30 menit auto-expiry
✅ Refresh token untuk perpanjang sesi
✅ Revoke all tokens untuk logout dari semua device
✅ Middleware untuk auto-check expired
✅ Warning 5 menit sebelum expired
