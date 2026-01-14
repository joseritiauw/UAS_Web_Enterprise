<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sleepy Panda')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a1d3f;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .auth-card {
            background-color: #1a1d3f;
            border: 2px solid #3d4272;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .logo-subtitle {
            font-size: 14px;
            color: #8e92bc;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .form-label {
            color: #8e92bc;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            background-color: #252847;
            border: 1px solid #3d4272;
            border-radius: 6px;
            color: #ffffff;
            padding: 12px 15px;
            font-size: 14px;
        }

        .form-control:focus {
            background-color: #252847;
            border-color: #14b8a6;
            color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(20, 184, 166, 0.15);
        }

        .form-control::placeholder {
            color: #5a5e8f;
        }

        .btn-primary {
            background: linear-gradient(135deg, #14b8a6 0%, #0ea89b 100%);
            border: none;
            border-radius: 6px;
            color: #ffffff;
            padding: 12px;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0ea89b 0%, #0d9488 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .btn-primary:disabled {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            cursor: not-allowed;
            opacity: 0.6;
        }

        .btn-secondary {
            background-color: transparent;
            border: 2px solid #3d4272;
            border-radius: 6px;
            color: #ffffff;
            padding: 12px;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #252847;
            border-color: #14b8a6;
            color: #14b8a6;
        }

        .text-link {
            color: #14b8a6;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .text-link:hover {
            color: #0ea89b;
            text-decoration: underline;
        }

        .forgot-password-link {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
        }

        .forgot-password-link p {
            color: #8e92bc;
            margin-bottom: 5px;
        }

        .error-message {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 6px;
            color: #f87171;
            padding: 10px 15px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .success-message {
            background-color: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.3);
            border-radius: 6px;
            color: #14b8a6;
            padding: 10px 15px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .input-icon {
            color: #5a5e8f;
            font-size: 16px;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #3d4272;
        }

        .divider span {
            background-color: #1a1d3f;
            padding: 0 15px;
            position: relative;
            color: #8e92bc;
            font-size: 13px;
        }
    </style>

    @yield('styles')
</head>

<body>
    @yield('content')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
