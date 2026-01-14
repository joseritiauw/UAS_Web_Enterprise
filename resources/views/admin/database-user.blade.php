@extends('layouts.dashboard')

@section('title', 'Database User - Sleepy Panda')

@section('content')
    <!-- Statistics Cards -->
    <div class="stats-grid-db">
        <div class="stat-card-db">
            <div class="stat-icon-db">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-info-db">
                <h3>Total Users</h3>
                <p>4500</p>
            </div>
        </div>

        <div class="stat-card-db">
            <div class="stat-icon-db">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-info-db">
                <h3>Active Users</h3>
                <p>3500</p>
            </div>
        </div>

        <div class="stat-card-db">
            <div class="stat-icon-db">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="stat-info-db">
                <h3>New Users</h3>
                <p>500</p>
            </div>
        </div>

        <div class="stat-card-db">
            <div class="stat-icon-db">
                <i class="fas fa-user-slash"></i>
            </div>
            <div class="stat-info-db">
                <h3>Inactive Users</h3>
                <p>500</p>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <!-- Table Controls -->
        <div class="table-controls">
            <div class="search-box-table">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search by name, email, or ID">
            </div>
            <div class="table-actions">
                <button class="btn-sort">
                    <i class="fas fa-filter"></i>
                    Sort by
                </button>
                <button class="btn-refresh">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Sleep Status</th>
                        <th>Status</th>
                        <th>Last Active</th>
                        <th>History</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="user-row" data-user-id="418230" data-user-name="Alfonso de"
                        data-user-email="Alfonso.de@gmail.com" data-user-phone="+6212345789">
                        <td>
                            <div class="user-info-cell">
                                <div class="user-avatar-cell">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-details">
                                    <div class="user-name">Alfonso de</div>
                                    <div class="user-id">ID #418230</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="contact-info">
                                <div class="contact-email">
                                    <i class="fas fa-envelope"></i>
                                    Alfonso.de@gmail.com
                                </div>
                                <div class="contact-phone">+6212345789</div>
                            </div>
                        </td>
                        <td>
                            <div class="sleep-status">
                                <div class="sleep-avg">Avg. Sleep: 7.2h</div>
                                <div class="sleep-quality">Quality: 85%</div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-active">Active</span>
                        </td>
                        <td>
                            <div class="last-active">
                                2024-02-01<br>14:30
                            </div>
                        </td>
                        <td>
                            <button class="btn-history">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="user-row" data-user-id="418231" data-user-name="Alfonso de"
                        data-user-email="Alfonso.de@gmail.com" data-user-phone="+6212345789">
                        <td>
                            <div class="user-info-cell">
                                <div class="user-avatar-cell">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-details">
                                    <div class="user-name">Alfonso de</div>
                                    <div class="user-id">ID #418230</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="contact-info">
                                <div class="contact-email">
                                    <i class="fas fa-envelope"></i>
                                    Alfonso.de@gmail.com
                                </div>
                                <div class="contact-phone">+6212345789</div>
                            </div>
                        </td>
                        <td>
                            <div class="sleep-status">
                                <div class="sleep-avg">Avg. Sleep: 12h</div>
                                <div class="sleep-quality">Quality: 20%</div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-inactive">Not Active</span>
                        </td>
                        <td>
                            <div class="last-active">
                                2024-02-01<br>14:30
                            </div>
                        </td>
                        <td>
                            <button class="btn-history">
                                <i class="fas fa-list"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Side Menu Panel -->
    <div class="side-menu-overlay" id="sideMenuOverlay"></div>
    <div class="side-menu" id="sideMenu">
        <div class="side-menu-header">
            <h3>User Management</h3>
            <button class="btn-close-menu" id="closeSideMenu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="side-menu-content">
            <!-- Database User Section -->
            <div class="menu-section">
                <button class="menu-section-btn active" data-section="database">
                    <i class="fas fa-database"></i>
                    Database User
                </button>
            </div>

            <!-- Update Data Section -->
            <div class="menu-section">
                <button class="menu-section-btn" data-section="update">
                    <i class="fas fa-edit"></i>
                    Update Data
                </button>
                <div class="section-content" id="updateDataSection" style="display: none;">
                    <form id="updateDataForm" class="side-form">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="updateName" class="form-input" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="updateEmail" class="form-input" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" id="updatePhone" class="form-input" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select id="updateStatus" class="form-input">
                                <option value="active">Active</option>
                                <option value="inactive">Not Active</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Reset Password Section -->
            <div class="menu-section">
                <button class="menu-section-btn" data-section="reset">
                    <i class="fas fa-key"></i>
                    Reset Password
                </button>
                <div class="section-content" id="resetPasswordSection" style="display: none;">
                    <form id="resetPasswordForm" class="side-form">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" id="newPassword" class="form-input" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" id="confirmPassword" class="form-input"
                                placeholder="Confirm password">
                        </div>
                        <button type="submit" class="btn-save">
                            <i class="fas fa-key"></i>
                            Reset Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .stats-grid-db {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card-db {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .stat-card-db:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .stat-icon-db {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .stat-info-db {
            flex: 1;
        }

        .stat-info-db h3 {
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 8px;
        }

        .stat-info-db p {
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .table-section {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
        }

        .search-box-table {
            position: relative;
            flex: 1;
            max-width: 500px;
        }

        .search-box-table input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            font-size: 14px;
        }

        .search-box-table input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .search-box-table input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .search-box-table i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .btn-sort,
        .btn-refresh {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 12px 20px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-sort:hover,
        .btn-refresh:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .table-container {
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table thead tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-table th {
            padding: 15px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            white-space: nowrap;
        }

        .user-table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .user-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .user-table td {
            padding: 20px 15px;
        }

        .user-info-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar-cell {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            flex-shrink: 0;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: white;
        }

        .user-id {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .contact-email {
            font-size: 13px;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .contact-email i {
            color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
        }

        .contact-phone {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }

        .sleep-status {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sleep-avg {
            font-size: 13px;
            color: white;
        }

        .sleep-quality {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-active {
            background: #3b82f6;
            color: white;
        }

        .badge-inactive {
            background: #ef4444;
            color: white;
        }

        .last-active {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
        }

        .btn-history {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-history:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 1200px) {
            .stats-grid-db {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-grid-db {
                grid-template-columns: 1fr;
            }

            .table-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box-table {
                max-width: 100%;
            }

            .table-actions {
                justify-content: stretch;
            }

            .btn-sort,
            .btn-refresh {
                flex: 1;
                justify-content: center;
            }
        }

        /* Side Menu Styles */
        .side-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .side-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .side-menu {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background: rgba(42, 46, 80, 0.95);
            backdrop-filter: blur(20px);
            border-left: 2px solid rgba(255, 255, 255, 0.1);
            z-index: 9999;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .side-menu.active {
            right: 0;
        }

        .side-menu-header {
            padding: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .side-menu-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin: 0;
        }

        .btn-close-menu {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 20px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-close-menu:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .side-menu-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .menu-section {
            margin-bottom: 15px;
        }

        .menu-section-btn {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 16px 20px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-align: left;
        }

        .menu-section-btn:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .menu-section-btn.active {
            background: transparent;
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .menu-section-btn i {
            font-size: 16px;
            width: 20px;
        }

        .section-content {
            padding: 20px 10px 10px;
        }

        .side-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.7);
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.08);
        }

        .btn-save {
            background: #00bfa5;
            border: none;
            border-radius: 8px;
            padding: 14px 20px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-save:hover {
            background: #00a88f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 191, 165, 0.3);
        }

        @media (max-width: 768px) {
            .side-menu {
                width: 100%;
                right: -100%;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        let currentUserId = null;

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.user-table tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Refresh button
        document.querySelector('.btn-refresh').addEventListener('click', function() {
            console.log('Refreshing data...');
            const icon = this.querySelector('i');
            icon.style.animation = 'spin 1s linear';
            setTimeout(() => {
                icon.style.animation = '';
            }, 1000);
        });

        // Sort button
        document.querySelector('.btn-sort').addEventListener('click', function() {
            console.log('Opening sort options...');
        });

        // User row click to open side menu
        document.querySelectorAll('.user-row').forEach(row => {
            row.addEventListener('click', function(e) {
                // Don't open if clicking history button
                if (e.target.closest('.btn-history')) {
                    return;
                }

                currentUserId = this.dataset.userId;
                const userName = this.dataset.userName;
                const userEmail = this.dataset.userEmail;
                const userPhone = this.dataset.userPhone;

                // Populate form
                document.getElementById('updateName').value = userName;
                document.getElementById('updateEmail').value = userEmail;
                document.getElementById('updatePhone').value = userPhone;

                // Open side menu
                openSideMenu();
            });
        });

        // History buttons
        document.querySelectorAll('.btn-history').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const row = this.closest('tr');
                const userName = row.querySelector('.user-name').textContent;
                console.log('Opening history for:', userName);
            });
        });

        // Side menu functions
        function openSideMenu() {
            document.getElementById('sideMenu').classList.add('active');
            document.getElementById('sideMenuOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSideMenu() {
            document.getElementById('sideMenu').classList.remove('active');
            document.getElementById('sideMenuOverlay').classList.remove('active');
            document.body.style.overflow = '';

            // Reset sections
            document.querySelectorAll('.menu-section-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelectorAll('.section-content').forEach(content => {
                content.style.display = 'none';
            });
            document.querySelector('.menu-section-btn[data-section="database"]').classList.add('active');
        }

        // Close button
        document.getElementById('closeSideMenu').addEventListener('click', closeSideMenu);

        // Overlay click
        document.getElementById('sideMenuOverlay').addEventListener('click', closeSideMenu);

        // Menu section buttons
        document.querySelectorAll('.menu-section-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const section = this.dataset.section;

                // Remove active from all buttons
                document.querySelectorAll('.menu-section-btn').forEach(b => {
                    b.classList.remove('active');
                });

                // Hide all section contents
                document.querySelectorAll('.section-content').forEach(content => {
                    content.style.display = 'none';
                });

                // Activate clicked button
                this.classList.add('active');

                // Show corresponding section
                if (section === 'update') {
                    document.getElementById('updateDataSection').style.display = 'block';
                } else if (section === 'reset') {
                    document.getElementById('resetPasswordSection').style.display = 'block';
                }
            });
        });

        // Update Data Form
        document.getElementById('updateDataForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                userId: currentUserId,
                name: document.getElementById('updateName').value,
                email: document.getElementById('updateEmail').value,
                phone: document.getElementById('updatePhone').value,
                status: document.getElementById('updateStatus').value
            };

            console.log('Updating user data:', formData);

            // Show success message
            alert('User data updated successfully!');
            closeSideMenu();

            // Here you can add AJAX call to update data in backend
        });

        // Reset Password Form
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const newPassword = document.getElementById('newPassword').value;
                    const confirmPassword = document.getElementById('confirmPassword').value;

                    if (newPassword !== confirmPassword) {
                        alert('Passwords do not match!');
                        return;
                    }

                    if (newPassword.length < 6) {
                        alert('Password must be at least 6 characters!');
                        return;
                    }

                    console.log('Resetting password for user:', currentUserId);

                    // Show success message
                    alert('Password reset successfully!');
                    closeSideMenu();

                    // Clear form
                    document.getElementById('newPassword').value = '';
                    document.getElementById('confirmPassword').value = '';

                    // Here you can add AJAX call to reset password in backend
                    // Add spin animation
                    const style = document.createElement('style');
                    style.textContent = `
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
                    document.head.appendChild(style);
    </script>
@endpush
