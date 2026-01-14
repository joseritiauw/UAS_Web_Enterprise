<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sleepy Panda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1d3f 0%, #252850 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }

        .auth-container {
            width: 100%;
            max-width: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 380px;
            height: auto;
            max-height: 85vh;
            background: rgba(42, 46, 80, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 12px;
            padding: 40px 30px;
            box-shadow: 
                0 8px 32px 0 rgba(0, 0, 0, 0.37),
                0 2px 8px 0 rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .auth-card::-webkit-scrollbar {
            width: 6px;
        }

        .auth-card::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .auth-card::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .auth-card::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 48px;
            margin-bottom: 10px;
            display: block;
        }

        h1 {
            color: white;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #8e92bc;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: white;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 40px 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #00bfa5;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(0, 191, 165, 0.1);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            font-size: 16px;
        }

        .input-valid {
            border-color: #00bfa5 !important;
        }

        .input-invalid {
            border-color: #ff6b6b !important;
        }

        .validation-message {
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .validation-message.error {
            color: #ff6b6b;
            display: block;
        }

        .validation-message.success {
            color: #00bfa5;
            display: block;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #00bfa5;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover:not(:disabled) {
            background: #00a891;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 191, 165, 0.3);
        }

        .btn-submit:disabled {
            background: rgba(0, 191, 165, 0.3);
            cursor: not-allowed;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #00bfa5;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #14b8a6;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid;
            animation: slideDown 0.3s ease-out;
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

        .alert-danger {
            background-color: rgba(255, 107, 107, 0.2);
            border-color: rgba(255, 107, 107, 0.5);
            color: #ff6b6b;
        }

        .alert-success {
            background-color: rgba(0, 191, 165, 0.2);
            border-color: rgba(0, 191, 165, 0.5);
            color: #00bfa5;
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.2);
            border-color: rgba(59, 130, 246, 0.5);
            color: #3b82f6;
        }

        .countdown-timer {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(249, 115, 22, 0.2);
            border: 1px solid rgba(249, 115, 22, 0.5);
            border-radius: 6px;
            color: #f97316;
            font-size: 13px;
            font-weight: 600;
            margin-top: 10px;
        }

        .countdown-timer.expired {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.5);
            color: #ef4444;
        }

        .countdown-timer i {
            font-size: 14px;
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
            z-index: 9998;
            pointer-events: none;
        }

        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: all;
        }

        .modal-content {
            background: rgba(42, 46, 80, 0.95);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 12px;
            padding: 40px 30px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .modal-icon.loading {
            color: #00bfa5;
            animation: spin 1s linear infinite;
        }

        .modal-icon.success {
            color: #00bfa5;
        }

        .modal-icon.error {
            color: #ff6b6b;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .modal-title {
            color: white;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .modal-message {
            color: #8e92bc;
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 30px 24px;
            }

            h1 {
                font-size: 22px;
            }

            .logo {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="logo-section">
                <span class="logo">🐼</span>
                <h1>Reset Password</h1>
                <p class="subtitle">Masukkan kode OTP dan password baru Anda</p>
            </div>

            @if ($errors->has('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- OTP Sent Notification -->
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Kode OTP telah dikirim ke email <strong>{{ $email }}</strong>
            </div>

            <!-- Countdown Timer -->
            <div id="countdownContainer" class="countdown-timer">
                <i class="fas fa-clock"></i>
                <span>Token kadaluarsa dalam: <strong id="countdown">15:00</strong></span>
            </div>

            <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label for="otp">Kode OTP</label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            id="otp" 
                            name="otp" 
                            placeholder="Masukkan 6 digit kode OTP"
                            maxlength="6"
                            required
                        >
                        <i class="fas fa-key input-icon"></i>
                    </div>
                    <div id="otpValidation" class="validation-message"></div>
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Minimal 8 karakter"
                            required
                        >
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                    <div id="passwordValidation" class="validation-message"></div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Ketik ulang password"
                            required
                        >
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                    <div id="confirmPasswordValidation" class="validation-message"></div>
                </div>

                <button type="submit" id="submitBtn" class="btn-submit" disabled>
                    Reset Password
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('login') }}">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal-content">
            <div id="modalIcon" class="modal-icon"></div>
            <h2 id="modalTitle" class="modal-title"></h2>
            <p id="modalMessage" class="modal-message"></p>
        </div>
    </div>

    <script>
        const otpInput = document.getElementById('otp');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('resetPasswordForm');

        // Validation states
        let isOtpValid = false;
        let isPasswordValid = false;
        let isConfirmPasswordValid = false;

        // OTP validation
        otpInput.addEventListener('input', function() {
            const otp = this.value.trim();
            const otpValidation = document.getElementById('otpValidation');

            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');

            if (otp.length === 0) {
                this.classList.remove('input-valid', 'input-invalid');
                otpValidation.className = 'validation-message';
                otpValidation.textContent = '';
                isOtpValid = false;
            } else if (otp.length !== 6) {
                this.classList.remove('input-valid');
                this.classList.add('input-invalid');
                otpValidation.className = 'validation-message error';
                otpValidation.textContent = 'Kode OTP harus 6 digit';
                isOtpValid = false;
            } else {
                this.classList.remove('input-invalid');
                this.classList.add('input-valid');
                otpValidation.className = 'validation-message success';
                otpValidation.textContent = 'Kode OTP valid';
                isOtpValid = true;
            }

            updateSubmitButton();
        });

        // Password validation
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const passwordValidation = document.getElementById('passwordValidation');

            if (password.length === 0) {
                this.classList.remove('input-valid', 'input-invalid');
                passwordValidation.className = 'validation-message';
                passwordValidation.textContent = '';
                isPasswordValid = false;
            } else if (password.length < 8) {
                this.classList.remove('input-valid');
                this.classList.add('input-invalid');
                passwordValidation.className = 'validation-message error';
                passwordValidation.textContent = 'Password minimal 8 karakter';
                isPasswordValid = false;
            } else {
                this.classList.remove('input-invalid');
                this.classList.add('input-valid');
                passwordValidation.className = 'validation-message success';
                passwordValidation.textContent = 'Password valid';
                isPasswordValid = true;
            }

            // Re-validate confirmation if it has value
            if (confirmPasswordInput.value.length > 0) {
                confirmPasswordInput.dispatchEvent(new Event('input'));
            }

            updateSubmitButton();
        });

        // Confirm password validation
        confirmPasswordInput.addEventListener('input', function() {
            const confirmPassword = this.value;
            const password = passwordInput.value;
            const confirmPasswordValidation = document.getElementById('confirmPasswordValidation');

            if (confirmPassword.length === 0) {
                this.classList.remove('input-valid', 'input-invalid');
                confirmPasswordValidation.className = 'validation-message';
                confirmPasswordValidation.textContent = '';
                isConfirmPasswordValid = false;
            } else if (confirmPassword !== password) {
                this.classList.remove('input-valid');
                this.classList.add('input-invalid');
                confirmPasswordValidation.className = 'validation-message error';
                confirmPasswordValidation.textContent = 'Password tidak cocok';
                isConfirmPasswordValid = false;
            } else {
                this.classList.remove('input-invalid');
                this.classList.add('input-valid');
                confirmPasswordValidation.className = 'validation-message success';
                confirmPasswordValidation.textContent = 'Password cocok';
                isConfirmPasswordValid = true;
            }

            updateSubmitButton();
        });

        // Update submit button state
        function updateSubmitButton() {
            if (isOtpValid && isPasswordValid && isConfirmPasswordValid) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        // Modal functions
        function showModal(type, title, message) {
            const modalOverlay = document.getElementById('modalOverlay');
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');

            // Set modal content based on type
            if (type === 'loading') {
                modalIcon.innerHTML = '<i class="fas fa-spinner loading"></i>';
                modalIcon.className = 'modal-icon loading';
            } else if (type === 'success') {
                modalIcon.innerHTML = '<i class="fas fa-check-circle success"></i>';
                modalIcon.className = 'modal-icon success';
            } else if (type === 'error') {
                modalIcon.innerHTML = '<i class="fas fa-times-circle error"></i>';
                modalIcon.className = 'modal-icon error';
            }

            modalTitle.textContent = title;
            modalMessage.textContent = message;

            // Show modal
            modalOverlay.classList.add('active');
        }

        function hideModal() {
            const modalOverlay = document.getElementById('modalOverlay');
            modalOverlay.classList.remove('active');
        }

        // Form submission with AJAX
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Show loading modal
            showModal('loading', 'Memproses...', 'Sedang memproses permintaan reset password Anda');

            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route("password.update") }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    // Show success modal
                    showModal('success', 'Password Berhasil Direset!', data.message);

                    // Redirect to login after 3 seconds
                    setTimeout(function() {
                        window.location.href = '{{ route("login") }}';
                    }, 3000);
                } else {
                    // Show error modal
                    showModal('error', 'Reset Password Gagal', data.message);

                    // Hide modal after 3 seconds
                    setTimeout(function() {
                        hideModal();
                    }, 3000);
                }
            } catch (error) {
                showModal('error', 'Terjadi Kesalahan', 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.');
                setTimeout(function() {
                    hideModal();
                }, 3000);
            }
        });

        // Countdown Timer (15 minutes = 900 seconds)
        let timeLeft = 900; // 15 minutes in seconds
        const countdownElement = document.getElementById('countdown');
        const countdownContainer = document.getElementById('countdownContainer');
        const submitBtn = document.getElementById('submitBtn');

        function updateCountdown() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            
            countdownElement.textContent = 
                String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
            
            if (timeLeft <= 0) {
                countdownContainer.classList.add('expired');
                countdownContainer.innerHTML = '<i class="fas fa-exclamation-triangle"></i> <span>Token telah kadaluarsa! <a href="{{ route(\'password.request\') }}" style="color: #ef4444; text-decoration: underline;">Kirim ulang</a></span>';
                
                // Disable form
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
                
                // Disable inputs
                document.getElementById('otp').disabled = true;
                document.getElementById('password').disabled = true;
                document.getElementById('password_confirmation').disabled = true;
                
                clearInterval(countdownInterval);
            } else {
                timeLeft--;
            }
        }

        // Update countdown every second
        const countdownInterval = setInterval(updateCountdown, 1000);
        
        // Initial update
        updateCountdown();
    </script>
</body>
</html>
