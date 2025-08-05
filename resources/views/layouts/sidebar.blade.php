<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { 
            margin: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a2332 50%, #2d3748 100%);
            color: #e2e8f0;
            min-height: 100vh;
        }

        .container { 
            display: flex; 
            min-height: 100vh; 
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #081825 0%, #1a2332 50%, #0a1420 100%);
            color: white;
            padding: 0;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            transform: translateX(-100%);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 140, 150, 0.2);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-right: 1px solid rgba(0, 140, 150, 0.3);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0, 140, 150, 0.05) 0%, rgba(26, 100, 140, 0.08) 100%);
            z-index: -1;
            animation: subtleShimmer 6s ease-in-out infinite alternate;
        }

        @keyframes subtleShimmer {
            0% { opacity: 0.3; }
            100% { opacity: 0.7; }
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(0, 140, 150, 0.3);
            background: rgba(0, 140, 150, 0.08);
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -50%;
            width: 200%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(0, 140, 150, 0.6), transparent);
            animation: headerSweep 8s linear infinite;
        }

        @keyframes headerSweep {
            0% { left: -50%; }
            100% { left: 100%; }
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 1;
        }

        .sidebar-header h2::before {
            content: "●";
            font-size: 20px;
            color: #008c96;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.1); opacity: 1; }
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section-title {
            padding: 0 20px 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #008c96;
            letter-spacing: 1px;
            position: relative;
        }

        .nav-section-title::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 20px;
            width: 30px;
            height: 2px;
            background: linear-gradient(90deg, #008c96, #1a648c);
            border-radius: 1px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #d1d5db;
            text-decoration: none;
            margin: 2px 15px;
            padding: 12px 15px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            font-weight: 500;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            width: 18px;
            text-align: center;
            font-size: 16px;
            position: relative;
            z-index: 2;
        }

        .sidebar a::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.6s ease;
            z-index: 1;
        }

        .sidebar a[href*="dashboard"]::before { content: "▣"; }
        .sidebar a[href*="about"]::before { content: "◉"; }
        .sidebar a[href*="events"]::before { content: "▽"; }
        .sidebar a[href*="profile"]::before { content: "◎"; }
        .sidebar a[href*="settings"]::before { content: "◈"; }

        .sidebar a:hover {
            background: linear-gradient(135deg, rgba(0, 140, 150, 0.2), rgba(26, 100, 140, 0.15));
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 140, 150, 0.2);
            color: #ffffff;
            border-left: 3px solid #008c96;
        }

        .sidebar a:hover::after {
            left: 100%;
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #008c96 0%, #1a648c 100%);
            box-shadow: 0 4px 15px rgba(0, 140, 150, 0.3);
            transform: translateX(3px);
            border-left: 3px solid #ffffff;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(0, 140, 150, 0.3);
            background: rgba(26, 35, 50, 0.6);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            color: #fed7d7;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            font-weight: 500;
            gap: 12px;
            width: 100%;
            background: linear-gradient(135deg, rgba(185, 28, 28, 0.2), rgba(220, 38, 38, 0.2));
            border: 1px solid rgba(185, 28, 28, 0.3);
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: "◀";
            font-size: 16px;
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, rgba(185, 28, 28, 0.3), rgba(220, 38, 38, 0.3));
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(185, 28, 28, 0.2);
        }

        .logout-btn:hover::before {
            transform: rotate(180deg) scale(1.1);
        }

        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #081825, #1a648c);
            color: white;
            border: none;
            padding: 12px 14px;
            border-radius: 12px;
            cursor: pointer;
            z-index: 999;
            transition: all 0.3s ease;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(0, 140, 150, 0.3);
        }

        .toggle-btn:hover {
            background: linear-gradient(135deg, #1a648c, #008c96);
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 140, 150, 0.4);
        }

        .toggle-btn.hidden {
            opacity: 0;
            pointer-events: none;
            transform: scale(0.9);
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Main Content */
        .main {
            flex-grow: 1;
            padding: 20px;
            background: linear-gradient(135deg, #1a2332 0%, #2d3748 50%, #374151 100%);
            min-height: 100vh;
            width: 100%;
            position: relative;
        }

        .main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23008c96" fill-opacity="0.03"><circle cx="30" cy="30" r="1"/></g></g></svg>');
            pointer-events: none;
            animation: patternFloat 20s linear infinite;
        }

        @keyframes patternFloat {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-60px); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar { width: 300px; }
            .main { padding: 15px; }
            .dashboard-grid { grid-template-columns: 1fr; }
            .header-section { flex-direction: column; align-items: stretch; }
            .search-container { margin-bottom: 15px; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggleBtn">☰</button>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>My App</h2>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main</div>
                    <a href="#" class="active">Dashboard</a>
                    <a href="#">About us</a>
                    <a href="#">Our events</a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">Other</div>
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                </div>
            </div>
            
            <div class="sidebar-footer">
                <a href="#" class="logout-btn">Logout</a>
            </div>
        </div>
        
        <div class="main">
            @yield('content')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
                toggleBtn.classList.toggle('hidden');
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                toggleBtn.classList.remove('hidden');
            }

            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });

            overlay.addEventListener('click', closeSidebar);

            document.addEventListener('click', function(e) {
                if (window.innerWidth >= 768) {
                    const isClickInsideSidebar = sidebar.contains(e.target);
                    const isClickOnToggleBtn = toggleBtn.contains(e.target);
                    
                    if (!isClickInsideSidebar && !isClickOnToggleBtn && sidebar.classList.contains('open')) {
                        closeSidebar();
                    }
                }
            });

            sidebar.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
    @stack('scripts')
</body>
</html>