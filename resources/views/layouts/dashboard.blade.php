<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Sleepy Panda')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1d3f 0%, #252850 100%);
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 270px;
            background: rgba(42, 46, 80, 0.8);
            backdrop-filter: blur(20px);
            border-right: 2px solid rgba(255, 255, 255, 0.1);
            padding: 30px 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            padding: 0 20px 30px;
            margin-bottom: 20px;
        }

        .sidebar-logo .logo {
            font-size: 48px;
            margin-bottom: 5px;
        }

        .sidebar-logo h2 {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin: 0;
            text-align: left;
        }

        .admin-site-label {
            font-size: 20px;
            font-weight: 600;
            color: white;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-menu {
            flex: 1;
            padding: 0 15px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .menu-item.active {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .menu-item-sub {
            padding-left: 50px;
            font-size: 13px;
        }

        .menu-item-sub i {
            font-size: 14px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 0;
            overflow-y: auto;
        }

        .top-header {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            padding: 15px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-logo .logo {
            font-size: 32px;
        }

        .header-logo h2 {
            font-size: 20px;
            font-weight: 600;
            color: white;
            margin: 0;
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            font-size: 14px;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-greeting {
            font-size: 14px;
            color: white;
            margin: 0;
        }

        .content-wrapper {
            padding: 0 40px 40px;
        }

        .btn-logout {
            background: #ef4444;
            border: none;
            border-radius: 6px;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
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

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .stat-info {
            flex: 1;
        }

        .stat-info h3 {
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 8px;
        }

        .stat-info p {
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-icon.blue {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .stat-icon.green {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }

        .stat-icon.purple {
            background: rgba(168, 85, 247, 0.2);
            color: #a855f7;
        }

        .stat-icon.orange {
            background: rgba(249, 115, 22, 0.2);
            color: #f97316;
        }

        /* Content Cards */
        .content-card {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .content-card h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
        }

        .success-message {
            background-color: rgba(0, 191, 165, 0.2);
            border: 1px solid rgba(0, 191, 165, 0.5);
            border-radius: 8px;
            color: #00bfa5;
            padding: 15px 20px;
            font-size: 14px;
            margin-bottom: 20px;
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

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 350px;
            margin-top: 20px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                left: -270px;
                top: 0;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s ease;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .content-wrapper {
                padding: 0 20px 20px;
            }

            .top-header {
                padding: 15px 20px;
            }

            .search-box {
                display: none;
            }

            .header-left {
                gap: 10px;
            }

            .header-logo h2 {
                font-size: 18px;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header-right {
                gap: 10px;
            }

            .user-info {
                display: none;
            }
        }

        /* Mobile Menu Overlay */
        .menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Hamburger Button */
        .hamburger-btn {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 8px;
            padding: 10px 12px;
            cursor: pointer;
            color: white;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 992px) {
            .hamburger-btn {
                display: block;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- Mobile Menu Overlay -->
    <div class="menu-overlay" id="menuOverlay" onclick="toggleMobileMenu()"></div>

    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="admin-site-label">
                Admin Site
                <button class="hamburger-btn" onclick="toggleMobileMenu()" style="float: right; margin-top: -5px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}"
                    class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('jurnal') }}" class="menu-item {{ request()->routeIs('jurnal') ? 'active' : '' }}">
                    <i class="fas fa-book"></i>
                    <span>Jurnal</span>
                </a>
                <a href="{{ route('report') }}" class="menu-item {{ request()->routeIs('report') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Report</span>
                </a>
                <a href="{{ route('database.user') }}"
                    class="menu-item {{ request()->routeIs('database.user') || request()->routeIs('update.data') || request()->routeIs('reset.password') ? 'active' : '' }}">
                    <i class="fas fa-database"></i>
                    <span>Database User</span>
                </a>
                @if (request()->routeIs('database.user') || request()->routeIs('update.data') || request()->routeIs('reset.password'))
                    <a href="{{ route('update.data') }}"
                        class="menu-item menu-item-sub {{ request()->routeIs('update.data') ? 'active' : '' }}">
                        <i class="fas fa-edit"></i>
                        <span>Update Data</span>
                    </a>
                    <a href="{{ route('reset.password') }}"
                        class="menu-item menu-item-sub {{ request()->routeIs('reset.password') ? 'active' : '' }}">
                        <i class="fas fa-key"></i>
                        <span>Reset Password</span>
                    </a>
                @endif
            </div>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                    @csrf
                    <button type="submit" class="btn-logout" style="width: 100%;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="main-content">
            <div class="top-header">
                <div class="header-left">
                    <button class="hamburger-btn" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="header-logo">
                        <div class="logo"><img src="{{ asset('images/panda.png') }}" alt="Panda Logo"
                                style="width: 40px; height: 40px; object-fit: contain;"></div>
                        <h2>Sleepy Panda</h2>
                    </div>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search">
                    </div>
                </div>
                <div class="header-right">
                    <div class="user-avatar"></div>
                    <div class="user-info">
                        <p class="user-greeting">Halo, Anthony</p>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('menuOverlay');

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close menu when clicking menu item (on mobile)
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    toggleMobileMenu();
                }
            });
        });

        // Close menu on window resize if desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('menuOverlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
    @stack('scripts')
</body>

</html>
