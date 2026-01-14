# SMTP Setup Guide - Sleepy Panda

## Fitur Forgot Password dengan SMTP

Aplikasi Sleepy Panda telah dilengkapi dengan fitur forgot password yang menggunakan SMTP untuk mengirim kode OTP (One-Time Password) ke email pengguna.

## Status Implementasi

✅ **Sudah Diimplementasi:**
- Route forgot password (`/forgot-password`)
- Controller untuk handle forgot password request
- Email template professional dengan branding Sleepy Panda
- Generate OTP 6 digit dengan masa berlaku 15 menit
- Database migration untuk menyimpan OTP dan expiry time
- Mode development (OTP di-log) dan mode production (OTP dikirim via email)

## Setup SMTP Gmail

### 1. Generate App Password di Gmail

1. Buka [Google Account](https://myaccount.google.com/)
2. Pilih **Security** dari menu kiri
3. Aktifkan **2-Step Verification** jika belum aktif
4. Scroll ke bawah, cari **App passwords**
5. Klik **App passwords**, pilih:
   - App: **Mail**
   - Device: **Other (Custom name)** → ketik "Sleepy Panda"
6. Klik **Generate**
7. Copy 16-digit app password yang muncul (contoh: `abcd efgh ijkl mnop`)

### 2. Update File .env

Buka file `.env` dan update baris berikut:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com        # Ganti dengan email Gmail Anda
MAIL_PASSWORD=your_app_password_here      # Paste app password (tanpa spasi)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@sleepypanda.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Contoh:**
```env
MAIL_USERNAME=developer@gmail.com
MAIL_PASSWORD=abcdefghijklmnop
```

### 3. Jalankan Migration

Jalankan migration untuk menambahkan kolom OTP ke database:

```bash
php artisan migrate
```

### 4. Restart Server

Setelah update `.env`, restart Laravel server:

```bash
# Tekan Ctrl+C untuk stop server
php artisan serve
```

## Testing Forgot Password

### Mode Development (Default)

Jika `MAIL_USERNAME` masih `your_email@gmail.com`, aplikasi akan:
- Generate OTP 6 digit
- Menyimpan ke database
- Log OTP ke file `storage/logs/laravel.log`
- Response akan include OTP untuk testing

Cek log dengan:
```bash
tail -f storage/logs/laravel.log
```

### Mode Production (Setelah Setup SMTP)

Setelah kredensial email dikonfigurasi:
- OTP akan dikirim ke email pengguna
- Email menggunakan template profesional
- OTP berlaku 15 menit
- Log tetap mencatat untuk audit

## Email Template Features

Email yang dikirim memiliki:
- 🐼 Logo dan branding Sleepy Panda
- Kode OTP 6 digit yang jelas
- Informasi masa berlaku (15 menit)
- Design responsive untuk mobile
- Pesan keamanan (jika tidak request, abaikan)

## Troubleshooting

### Email tidak terkirim

1. **Cek kredensial:**
   ```bash
   php artisan tinker
   >>> config('mail.mailers.smtp.username')
   >>> config('mail.mailers.smtp.password')
   ```

2. **Cek log error:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. **Pastikan App Password benar:**
   - Tidak ada spasi
   - Copy paste langsung dari Google
   - Generate ulang jika perlu

4. **Firewall/Antivirus:**
   - Pastikan port 587 tidak diblok
   - Whitelist domain smtp.gmail.com

### OTP tidak valid

- OTP berlaku 15 menit
- Setelah expired, request forgot password baru
- OTP hanya bisa digunakan sekali

## Security Notes

⚠️ **PENTING:**
- **JANGAN** commit file `.env` ke Git
- App password Gmail hanya untuk aplikasi ini
- Gunakan email khusus untuk aplikasi (bukan email pribadi)
- Revoke app password jika tidak digunakan lagi

## Files Modified

```
sleepypanda/
├── app/
│   ├── Http/Controllers/AuthController.php  (Updated forgot password logic)
│   └── Models/User.php                       (Added OTP fields)
├── database/migrations/
│   └── 2026_01_14_000001_add_otp_columns_to_users_table.php
├── resources/views/emails/
│   └── forgot-password.blade.php            (Email template)
├── .env                                      (Email credentials)
└── SMTP_SETUP_GUIDE.md                      (This file)
```

## Next Steps

1. ✅ Generate Gmail App Password
2. ✅ Update `.env` dengan kredensial
3. ✅ Run migration: `php artisan migrate`
4. ✅ Restart server
5. ✅ Test forgot password feature
6. ✅ Cek email atau log untuk OTP

---

**Developed for Sleepy Panda - Mental Health Monitoring System**
