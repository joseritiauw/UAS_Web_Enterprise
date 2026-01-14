@extends('layouts.dashboard')

@section('title', 'Update Data - Sleepy Panda')

@section('content')
    @if (session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="update-data-container">
        <h2><i class="fas fa-edit"></i> Update User Data</h2>

        <form action="{{ route('update.data.post') }}" method="POST" class="update-form">
            @csrf

            <input type="hidden" name="user_id" id="userId" value="">

            <div class="form-row">
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user"></i>
                        Name
                    </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                        required value="{{ old('name') }}">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email"
                        required value="{{ old('email') }}">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">
                        <i class="fas fa-phone"></i>
                        Phone Number
                    </label>
                    <input type="tel" name="phone" id="phone" class="form-control"
                        placeholder="Enter phone number" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">
                        <i class="fas fa-toggle-on"></i>
                        Status
                    </label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Not Active</option>
                    </select>
                    @error('status')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('database.user') }}" class="btn-cancel">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
            </div>
        </form>

        <!-- Recent Users Table -->
        <div class="recent-users-section">
            <h3><i class="fas fa-users"></i> Select User to Update</h3>
            <div class="users-grid">
                <div class="user-card" data-user-id="418230" data-name="Alfonso de" data-email="Alfonso.de@gmail.com"
                    data-phone="+6212345789" data-status="active">
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

                <div class="user-card" data-user-id="418231" data-name="Maria Garcia" data-email="maria.garcia@gmail.com"
                    data-phone="+6212345790" data-status="inactive">
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
        .update-data-container {
            max-width: 1200px;
        }

        .update-data-container>h2 {
            font-size: 24px;
            font-weight: 600;
            color: white;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .update-form {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
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

        .error-message {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-cancel,
        .btn-save {
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

        .btn-save {
            background: #00bfa5;
            color: white;
        }

        .btn-save:hover {
            background: #00a88f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 191, 165, 0.3);
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
            border-color: #00bfa5;
            transform: translateY(-2px);
        }

        .user-card.selected {
            border-color: #00bfa5;
            background: rgba(0, 191, 165, 0.1);
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
            .btn-save {
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
        document.querySelectorAll('.user-card').forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                document.querySelectorAll('.user-card').forEach(c => c.classList.remove('selected'));

                // Add selected class to clicked card
                this.classList.add('selected');

                // Populate form
                document.getElementById('userId').value = this.dataset.userId;
                document.getElementById('name').value = this.dataset.name;
                document.getElementById('email').value = this.dataset.email;
                document.getElementById('phone').value = this.dataset.phone;
                document.getElementById('status').value = this.dataset.status;

                // Scroll to form
                document.querySelector('.update-form').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    </script>
@endpush
