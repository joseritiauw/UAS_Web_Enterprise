@extends('layouts.dashboard')

@section('title', 'Reset Password - Sleepy Panda')

@section('content')
    @if (session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="reset-password-container">
        <h2><i class="fas fa-key"></i> Reset User Password</h2>

        <form action="{{ route('reset.password.post') }}" method="POST" class="reset-form">
            @csrf

            <input type="hidden" name="user_id" id="userId" value="">

            <div class="selected-user-info" id="selectedUserInfo" style="display: none;">
                <div class="user-info-header">
                    <i class="fas fa-user-circle"></i>
                    <div>
                        <div class="selected-user-name" id="selectedUserName"></div>
                        <div class="selected-user-email" id="selectedUserEmail"></div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="new_password">
                        <i class="fas fa-lock"></i>
                        New Password
                    </label>
                    <input type="password" name="new_password" id="new_password" class="form-control"
                        placeholder="Enter new password" required minlength="8">
                    @error('new_password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <small class="help-text">Minimum 8 characters</small>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">
                        <i class="fas fa-lock"></i>
                        Confirm Password
                    </label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                        class="form-control" placeholder="Confirm new password" required minlength="8">
                    <small class="help-text">Re-enter password to confirm</small>
                </div>
            </div>

            <div class="password-strength" id="passwordStrength">
                <div class="strength-label">Password Strength:</div>
                <div class="strength-bar">
                    <div class="strength-bar-fill" id="strengthBarFill"></div>
                </div>
                <div class="strength-text" id="strengthText">No password</div>
            </div>

            <div class="form-actions">
                <a href="{{ route('database.user') }}" class="btn-cancel">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
                <button type="submit" class="btn-reset" id="resetBtn" disabled>
                    <i class="fas fa-key"></i>
                    Reset Password
                </button>
            </div>
        </form>

        <!-- Recent Users Table -->
        <div class="recent-users-section">
            <h3><i class="fas fa-users"></i> Select User</h3>
            <div class="users-grid">
                <div class="user-card" data-user-id="418230" data-name="Alfonso de" data-email="Alfonso.de@gmail.com">
                    <div class="user-card-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-card-info">
                        <div class="user-card-name">Alfonso de</div>
                        <div class="user-card-id">ID #418230</div>
                        <div class="user-card-email">Alfonso.de@gmail.com</div>
                        <span class="user-card-badge badge-active">Active</span>
                    </div>
                </div>

                <div class="user-card" data-user-id="418231" data-name="Maria Garcia" data-email="maria.garcia@gmail.com">
                    <div class="user-card-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-card-info">
                        <div class="user-card-name">Maria Garcia</div>
                        <div class="user-card-id">ID #418231</div>
                        <div class="user-card-email">maria.garcia@gmail.com</div>
                        <span class="user-card-badge badge-inactive">Not Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .reset-password-container {
            max-width: 1200px;
        }

        .reset-password-container>h2 {
            font-size: 24px;
            font-weight: 600;
            color: white;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .reset-form {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .selected-user-info {
            background: rgba(0, 191, 165, 0.1);
            border: 1px solid rgba(0, 191, 165, 0.3);
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .user-info-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info-header i {
            font-size: 32px;
            color: #00bfa5;
        }

        .selected-user-name {
            font-size: 16px;
            font-weight: 600;
            color: white;
        }

        .selected-user-email {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 2px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label i {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-control:focus {
            outline: none;
            border-color: #00bfa5;
            background: rgba(255, 255, 255, 0.08);
        }

        .help-text {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.5);
        }

        .error-message {
            font-size: 12px;
            color: #ef4444;
        }

        .password-strength {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .strength-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 8px;
        }

        .strength-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 4px;
        }

        .strength-text {
            font-size: 12px;
            font-weight: 600;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-cancel,
        .btn-reset {
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .btn-reset {
            background: #ef4444;
            color: white;
        }

        .btn-reset:hover:not(:disabled) {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-reset:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .recent-users-section {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .recent-users-section h3 {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .user-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            gap: 15px;
        }

        .user-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: #ef4444;
            transform: translateY(-2px);
        }

        .user-card.selected {
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }

        .user-card-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            flex-shrink: 0;
        }

        .user-card-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .user-card-name {
            font-size: 15px;
            font-weight: 600;
            color: white;
        }

        .user-card-id {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .user-card-email {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 6px;
        }

        .user-card-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            width: fit-content;
        }

        .badge-active {
            background: #3b82f6;
            color: white;
        }

        .badge-inactive {
            background: #ef4444;
            color: white;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-reset {
                width: 100%;
                justify-content: center;
            }

            .users-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        let selectedUserId = null;

        // User card selection
        document.querySelectorAll('.user-card').forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                document.querySelectorAll('.user-card').forEach(c => c.classList.remove('selected'));

                // Add selected class to clicked card
                this.classList.add('selected');

                // Store user ID
                selectedUserId = this.dataset.userId;
                document.getElementById('userId').value = selectedUserId;

                // Show selected user info
                document.getElementById('selectedUserInfo').style.display = 'block';
                document.getElementById('selectedUserName').textContent = this.dataset.name;
                document.getElementById('selectedUserEmail').textContent = this.dataset.email;

                // Enable reset button if passwords are valid
                checkPasswordMatch();

                // Scroll to form
                document.querySelector('.reset-form').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // Password strength checker
        const newPasswordInput = document.getElementById('new_password');
        const confirmPasswordInput = document.getElementById('new_password_confirmation');
        const strengthBarFill = document.getElementById('strengthBarFill');
        const strengthText = document.getElementById('strengthText');
        const resetBtn = document.getElementById('resetBtn');

        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let strengthLabel = '';
            let color = '';

            if (password.length === 0) {
                strength = 0;
                strengthLabel = 'No password';
                color = 'transparent';
            } else if (password.length < 6) {
                strength = 25;
                strengthLabel = 'Weak';
                color = '#ef4444';
            } else if (password.length < 8) {
                strength = 50;
                strengthLabel = 'Fair';
                color = '#f59e0b';
            } else if (password.length < 12) {
                strength = 75;
                strengthLabel = 'Good';
                color = '#10b981';
            } else {
                strength = 100;
                strengthLabel = 'Strong';
                color = '#00bfa5';
            }

            strengthBarFill.style.width = strength + '%';
            strengthBarFill.style.background = color;
            strengthText.textContent = strengthLabel;
            strengthText.style.color = color;

            checkPasswordMatch();
        });

        confirmPasswordInput.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const newPass = newPasswordInput.value;
            const confirmPass = confirmPasswordInput.value;

            if (selectedUserId && newPass.length >= 6 && newPass === confirmPass) {
                resetBtn.disabled = false;
            } else {
                resetBtn.disabled = true;
            }
        }

        // Form submission
        document.querySelector('.reset-form').addEventListener('submit', function(e) {
            const newPass = newPasswordInput.value;
            const confirmPass = confirmPasswordInput.value;

            if (!selectedUserId) {
                e.preventDefault();
                alert('Please select a user first!');
                return;
            }

            if (newPass !== confirmPass) {
                e.preventDefault();
                alert('Passwords do not match!');
                return;
            }

            if (newPass.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters!');
                return;
            }
        });
    </script>
@endpush
