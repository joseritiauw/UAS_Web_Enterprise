<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sleepy Panda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1d3f 0%, #252850 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 30px 20px;
        }

        .container {
            width: 100%;
            max-width: 380px;
            position: relative;
        }

        .card {
            background: rgba(30, 33, 66, 0.7);
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 1px;
            padding: 90px 30px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4),
                0 0 40px rgba(0, 191, 165, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-container img {
            width: 70px;
            height: auto;
            margin: 0 auto 15px;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .logo-container h1 {
            font-size: 24px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.5px;
            margin: 0 0 8px 0;
        }

        .logo-container p {
            font-size: 13px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 16px;
            top: 13px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 16px;
            pointer-events: none;
            z-index: 1;
        }

        .forgot-link {
            text-align: right;
            margin-top: 6px;
            margin-bottom: 24px;
        }

        .forgot-link a {
            font-size: 12px;
            color: #00bfa5;
            text-decoration: none;
            font-weight: 400;
        }

        .forgot-link a:hover {
            color: #00d4b8;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
        }

        .register-link a {
            color: #00bfa5;
            text-decoration: none;
            font-weight: 500;
            margin-left: 4px;
        }

        .register-link a:hover {
            color: #00d4b8;
            text-decoration: underline;
        }

        .form-label {
            display: none;
        }

        .form-control {
            width: 100%;
            padding: 13px 16px 13px 48px;
            background: rgba(20, 23, 50, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: white;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-control:focus {
            outline: none;
            border-color: #00bfa5;
            background: rgba(20, 23, 50, 0.7);
        }

        .error-message {
            font-size: 12px;
            color: #ff6b6b;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .alert-error {
            background: rgba(255, 107, 107, 0.2);
            border: 1px solid rgba(255, 107, 107, 0.5);
            color: #ff6b6b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            text-align: center;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            width: 100%;
            padding: 14px 24px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-primary {
            background: #00bfa5;
            color: white;
            margin-bottom: 16px;
            box-shadow: 0 4px 12px rgba(0, 191, 165, 0.3);
        }

        .btn-primary:hover:not(:disabled) {
            background: #00d4b8;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 191, 165, 0.4);
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .forgot-password {
            text-align: center;
            margin-bottom: 20px;
            display: none;
        }

        .divider {
            display: none;
        }

        .btn-outline {
            display: none;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
            pointer-events: none;
        }

        .modal-overlay.show {
            display: flex;
            pointer-events: all;
        }

        .modal-content {
            background: rgba(30, 33, 66, 0.95);
            border: 1px solid rgba(0, 191, 165, 0.3);
            border-radius: 16px;
            padding: 40px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: slideIn 0.3s ease;
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .modal-icon.loading {
            background: linear-gradient(135deg, rgba(0, 191, 165, 0.2), rgba(0, 166, 147, 0.2));
            color: #00bfa5;
        }

        .modal-icon.success {
            background: linear-gradient(135deg, rgba(0, 191, 165, 0.2), rgba(0, 166, 147, 0.2));
            color: #00bfa5;
        }

        .modal-icon.error {
            background: linear-gradient(135deg, rgba(255, 107, 107, 0.2), rgba(255, 71, 87, 0.2));
            color: #ff6b6b;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .modal-message {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            margin-bottom: 0;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 191, 165, 0.2);
            border-top-color: #00bfa5;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Forgot Password Slide-Up Panel */
        .forgot-password-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
            z-index: 9998;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .forgot-password-backdrop.active {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            opacity: 1;
            padding-bottom: 0;
        }

        .forgot-password-panel {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translate(-50%, 100%);
            width: 90%;
            max-width: 380px;
            background: rgba(30, 33, 66, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 20px 20px 0 0;
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-bottom: none;
            padding: 50px 40px 40px;
            z-index: 9999;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.5),
                0 0 40px rgba(0, 191, 165, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            opacity: 1;
            visibility: hidden;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), visibility 0.4s;
        }

        .forgot-password-panel.active {
            visibility: visible;
            transform: translate(-50%, 0);
        }

        .panel-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .panel-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin: 0 0 10px 0;
        }

        .panel-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .panel-close:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: rotate(90deg);
        }

        .panel-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 25px;
            text-align: center;
        }

        .panel-form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .panel-form-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(0, 0, 0, 0.5);
            font-size: 16px;
            pointer-events: none;
            z-index: 1;
        }

        .panel-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            background: white;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            color: #1a1d3f;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .panel-input:focus {
            outline: none;
            border-color: #00bfa5;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 191, 165, 0.1);
        }

        .panel-input::placeholder {
            color: rgba(0, 0, 0, 0.4);
        }

        .panel-btn {
            width: 100%;
            padding: 14px;
            background: #00bfa5;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 15px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 5px;
        }

        .panel-btn:hover:not(:disabled) {
            background: #00d4b8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 191, 165, 0.3);
        }

        .panel-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .panel-alert {
            padding: 16px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.6;
        }

        .panel-alert span {
            flex: 1;
        }

        .panel-alert.success {
            background: rgba(0, 191, 165, 0.2);
            border: 1px solid rgba(0, 191, 165, 0.5);
            color: #00bfa5;
        }

        .panel-alert.error {
            background: rgba(255, 107, 107, 0.2);
            border: 1px solid rgba(255, 107, 107, 0.5);
            color: #ff6b6b;
        }

        @media (max-width: 480px) {
            .card {
                padding: 40px 30px;
            }

            .logo-container img {
                width: 60px;
            }

            .logo-container h1 {
                font-size: 22px;
            }

            .forgot-password-panel {
                padding: 40px 25px 30px;
                width: 100%;
                max-width: 100%;
                border-radius: 16px 16px 0 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="logo-container">
                <img src="{{ asset('images/panda.png') }}" alt="Sleepy Panda Logo">
                <h1>Sleepy Panda</h1>
                <p>Masuk menggunakan akun yang<br>sudah kamu daftarkan</p>
            </div>

            <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                @csrf

                @if ($errors->has('error'))
                    <div class="alert-error">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first('error') }}
                    </div>
                @endif

                <div class="form-group">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                        required value="{{ old('email') }}">
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                    <div class="error-message" id="passwordError"></div>
                </div>

                <div class="forgot-link">
                    <a href="#" onclick="openForgotPasswordPanel(); return false;">Lupa password?</a>
                </div>

                <button type="submit" class="btn btn-primary" id="loginBtn">Masuk</button>
            </form>

            <div class="register-link">
                Belum memiliki akun? <a href="{{ route('register') }}">Daftar</a>
            </div>
        </div>
    </div>

    <!-- Forgot Password Slide-Up Panel -->
    <div class="forgot-password-backdrop" id="forgotPasswordBackdrop" onclick="closeForgotPasswordPanel()"></div>
    <div class="forgot-password-panel" id="forgotPasswordPanel">
        <button class="panel-close" onclick="closeForgotPasswordPanel()">
            <i class="fas fa-times"></i>
        </button>

        <div class="panel-header">
            <h3>Lupa password?</h3>
        </div>

        <p class="panel-description">
            Instruksi untuk melakukan reset password akan<br>
            dikirim melalui email yang kamu gunakan untuk<br>
            mendaftar
        </p>

        <div id="forgotPasswordAlert"></div>

        <form id="forgotPasswordForm" onsubmit="handleForgotPassword(event)">
            @csrf
            <div class="panel-form-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" id="forgotEmail" name="email" class="panel-input" placeholder="Email" required>
            </div>

            <button type="submit" class="panel-btn" id="forgotPasswordBtn">
                Reset Password
            </button>
        </form>
    </div>

    <script>
        // Forgot Password Panel Functions
        function openForgotPasswordPanel() {
            const backdrop = document.getElementById('forgotPasswordBackdrop');
            const panel = document.getElementById('forgotPasswordPanel');

            backdrop.classList.add('active');
            setTimeout(() => {
                panel.classList.add('active');
            }, 10);
        }

        function closeForgotPasswordPanel() {
            const backdrop = document.getElementById('forgotPasswordBackdrop');
            const panel = document.getElementById('forgotPasswordPanel');
            const alertBox = document.getElementById('forgotPasswordAlert');

            panel.classList.remove('active');
            setTimeout(() => {
                backdrop.classList.remove('active');
                // Clear alert after closing
                alertBox.innerHTML = '';
            }, 400);
        }

        function showPanelAlert(type, message) {
            const alertBox = document.getElementById('forgotPasswordAlert');
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

            alertBox.innerHTML = `
                <div class="panel-alert ${type}">
                    <i class="fas ${icon}"></i>
                    <span>${message}</span>
                </div>
            `;
        }

        async function handleForgotPassword(event) {
            event.preventDefault();

            const form = event.target;
            const submitBtn = document.getElementById('forgotPasswordBtn');
            const emailInput = document.getElementById('forgotEmail');
            const formData = new FormData(form);

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ||
                document.querySelector('input[name="_token"]')?.value;

            // Add CSRF token to FormData if not already present
            if (!formData.has('_token') && csrfToken) {
                formData.append('_token', csrfToken);
            }

            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

            try {
                const response = await fetch('{{ route('password.email') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showPanelAlert('success', data.message);

                    // Clear form
                    emailInput.value = '';

                    // Close panel after 4 seconds
                    setTimeout(() => {
                        closeForgotPasswordPanel();
                    }, 4000);
                } else {
                    showPanelAlert('error', data.message || 'Terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                showPanelAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Reset Password';
            }
        }

        // Simple validation without blocking form submission
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        // Validasi password
        function validatePassword(password) {
            if (!password) {
                return {
                    valid: false,
                    message: 'Password tidak boleh kosong'
                };
            }

            if (password.length < 8) {
                return {
                    valid: false,
                    message: 'Password minimal 8 karakter'
                };
            }

            return {
                valid: true
            };
        }

        // Real-time validation (tidak menghalangi submit)
        emailInput.addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Validasi format email
            if (this.value && !emailRegex.test(this.value)) {
                emailError.textContent = 'username/password incorrect';
                emailError.classList.add('show');
                this.style.borderColor = '#ff6b6b';
            }
            // Validasi domain @ganteng.com
            else if (this.value && this.value.endsWith('@ganteng.com')) {
                emailError.textContent = 'username/password incorrect';
                emailError.classList.add('show');
                this.style.borderColor = '#ff6b6b';
            } else {
                emailError.classList.remove('show');
                this.style.borderColor = 'rgba(255, 255, 255, 0.15)';
            }
        });

        passwordInput.addEventListener('input', function() {
            const validation = validatePassword(this.value);
            if (!validation.valid && this.value) {
                passwordError.textContent = validation.message;
                passwordError.classList.add('show');
                this.style.borderColor = '#ff6b6b';
            } else {
                passwordError.classList.remove('show');
                this.style.borderColor = 'rgba(255, 255, 255, 0.15)';
            }
        });

        // Check for success message (from registration)
        @if (session('success'))
            setTimeout(function() {
                showModal('success', 'Berhasil!', '{{ session('success') }}');
                setTimeout(function() {
                    hideModal();
                }, 3000);
            }, 100);
        @endif

        // Modal functions
        function showModal(type, title, message) {
            const overlay = document.getElementById('modalOverlay');
            const icon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');

            // Reset icon classes
            icon.className = 'modal-icon ' + type;

            // Update content based on type
            if (type === 'loading') {
                icon.innerHTML = '<div class="spinner"></div>';
            } else if (type === 'success') {
                icon.innerHTML = '<i class="fa-solid fa-check"></i>';
            } else if (type === 'error') {
                icon.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            }

            modalTitle.textContent = title;
            modalMessage.textContent = message;
            overlay.classList.add('show');
        }

        function hideModal() {
            const overlay = document.getElementById('modalOverlay');
            overlay.classList.remove('show');
        }

        // Handle login form submission
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            // Let the form submit normally, don't use AJAX
            // Just show validation errors if any before submitting
            const emailValidation = emailInput.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
            const passwordValidation = passwordInput.value && passwordInput.value.length < 8;

            if (emailValidation || passwordValidation) {
                event.preventDefault();
                return false;
            }

            // Show loading state
            const submitBtn = document.getElementById('loginBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            // Let form submit normally
            return true;
        });
    </script>
</body>

</html>
