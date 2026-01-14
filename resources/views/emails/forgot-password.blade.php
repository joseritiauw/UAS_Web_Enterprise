<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sleepy Panda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #14b8a6 0%, #0ea89b 100%);
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            color: #1a1d3f;
            margin-top: 0;
        }

        .content p {
            color: #555;
            line-height: 1.6;
        }

        .otp-box {
            background-color: #f0f9ff;
            border: 2px solid #14b8a6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }

        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #1a1d3f;
            letter-spacing: 5px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #14b8a6 0%, #0ea89b 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: 600;
        }

        .footer {
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>🐼 Sleepy Panda</h1>
        </div>
        <div class="content">
            <h2>Reset Password</h2>
            <p>Halo,</p>
            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>

            <div class="otp-box">
                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">Kode OTP Anda:</p>
                <div class="otp-code">{{ $otp }}</div>
                <p style="margin: 10px 0 0 0; color: #666; font-size: 12px;">Kode ini berlaku selama 15 menit</p>
            </div>

            <p>Gunakan kode OTP di atas untuk mereset password Anda.</p>

            <p style="margin-top: 30px; font-size: 13px; color: #888;">
                Jika Anda tidak meminta reset password, abaikan email ini.<br>
                Link dan kode OTP ini akan kadaluarsa dalam 15 menit.
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sleepy Panda. All rights reserved.</p>
            <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>

</html>
