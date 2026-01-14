<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sleepy Panda</title>
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
        }

        .card {
            background: rgba(30, 33, 66, 0.7);
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 12px;
            padding: 50px 40px;
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

        .success-message {
            font-size: 12px;
            color: #00bfa5;
            margin-top: 5px;
            display: none;
        }

        .success-message.show {
            display: block;
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

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
        }

        .login-link a {
            color: #00bfa5;
            text-decoration: none;
            font-weight: 500;
            margin-left: 4px;
        }

        .login-link a:hover {
            color: #00d4b8;
            text-decoration: underline;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="logo-container">
                <img src="{{ asset('images/panda.png') }}" alt="Sleepy Panda Logo">
                <h1>Sleepy Panda</h1>
                <p>Reset password untuk akun Anda<br>dengan memasukkan email</p>
            </div>

            <form id="forgotForm" action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                        required>
                    <div class="error-message" id="emailError"></div>
                    <div class="success-message" id="emailSuccess"></div>
                </div>

                <button type="submit" class="btn btn-primary" id="resetBtn">Reset Password</button>
            </form>

            <div class="login-link">
                Ingat password Anda? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div class="modal-icon loading" id="modalIcon">
                <div class="spinner"></div>
            </div>
            <h3 class="modal-title" id="modalTitle">Memproses...</h3>
            <p class="modal-message" id="modalMessage">Mohon tunggu sebentar</p>
        </div>
    </div>

    <script>
        const form = document.getElementById('forgotForm');
        const emailInput = document.getElementById('email');
        const resetBtn = document.getElementById('resetBtn');
        const emailError = document.getElementById('emailError');
        const emailSuccess = document.getElementById('emailSuccess');

        // Validasi email
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!email) {
                return {
                    valid: false,
                    message: 'Email tidak boleh kosong'
                };
            }

            if (!emailRegex.test(email)) {
                return {
                    valid: false,
                    message: 'Email Anda Salah'
                };
            }

            return {
                valid: true
            };
        }

        // Real-time validation
        emailInput.addEventListener('input', function() {
            const validation = validateEmail(this.value);
            emailSuccess.classList.remove('show');

            if (!validation.valid && this.value) {
                emailError.textContent = validation.message;
                emailError.classList.add('show');
                this.style.borderColor = '#ff6b6b';
            } else {
                emailError.classList.remove('show');
                this.style.borderColor = 'rgba(255, 255, 255, 0.15)';
            }
        });

        // Form submission
        form.addEventListener('submit', function(e) {
                e.preventDefault();

                const emailValidation = validateEmail(emailInput.value);

                // Reset errors
                emailError.classList.remove('show');
                emailSuccess.classList.remove('show');
                emailInput.style.borderColor = 'rgba(255, 255, 255, 0.15)';

                if (!emailValidation.valid) {
                    emailError.textContent = emailValidation.message;
                    emailError.classList.add('show');
                    emailInput.style.borderColor = '#ff6b6b';
                    return;
                }

                // Show loading modal
                showModal('loading', 'Mengirim Email...', 'Sedang memproses permintaan Anda');

                // Submit form using AJAX
                const formData = new FormData(this);

                fetch('{{ route('password.email') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success modal with detailed information
                            showModal('success', 'Email Berhasil Dikirim!',
                                'Link reset password dan kode OTP 6 digit telah dikirim ke email Anda. Silakan periksa inbox atau folder spam. Link akan kadaluarsa dalam 15 menit.'
                            );

                            // Clear form
                            emailInput.value = '';

                            // Hide modal after 7 seconds (longer message needs more time)
                            setTimeout(function() {
                                hideModal();
                            }, 7000);
                        } else {
                            // Show error modal
                            showModal('error', 'Gagal!', data.message || 'Terjadi kesalahan');

                            // Hide modal after 3 seconds
                            setTimeout(function() {
                                hideModal();
                            }, 3000);
                        }
                    })
                    .catch(error => {
                        showModal('error', 'Gagal!', 'Terjadi kesalahan. Silakan coba lagi.');
                        setTimeout(function() {
                            hideModal();
                        }, 3000);
                    });
            }

            modalTitle.textContent = title; modalMessage.textContent = message; overlay.classList.add('show');
        }

        function hideModal() {
            const overlay = document.getElementById('modalOverlay');
            overlay.classList.remove('show');
        }
    </script>
</body>

</html>
