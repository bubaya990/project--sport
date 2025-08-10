<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #00c8d7;
            --primary-light: rgba(0, 200, 215, 0.1);
            --primary-dark: #0095a8;
            --secondary: #1e293b;
            --secondary-light: #334155;
            --secondary-dark: #0f172a;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f1f5f9;
            --dark: #0f172a;
            --darker: #020617;
            --text: #e2e8f0;
            --text-secondary: #94a3b8;
            --card-bg: rgba(30, 41, 59, 0.6);
            --card-border: rgba(0, 200, 215, 0.15);
        }
        
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--darker);
            color: var(--text);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Main Content */
        .main {
            flex-grow: 1;
            padding: 20px;
            background: linear-gradient(135deg, #1a2332 0%, #2d3748 50%, #374151 100%);
            min-height: 100vh;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            background: rgba(30, 41, 59, 0.7);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            width: 100%;
            max-width: 100vw;
        }

        .top-nav.scrolled {
            background: rgba(30, 41, 59, 0.9);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        }

        .nav-logo {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-logo:hover {
            transform: scale(1.05);
        }

        .nav-logo i {
            font-size: 22px;
        }

        .nav-links {
            display: flex;
            gap: 5px;
            margin: 0 20px;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--text);
            background: rgba(0, 200, 215, 0.1);
        }

        .nav-link.active {
            color: var(--primary);
            background: rgba(0, 200, 215, 0.2);
        }

        .nav-link i {
            font-size: 16px;
        }

        .nav-search {
            flex: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 25px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 0 0 3px rgba(0, 200, 215, 0.3);
        }

        /* Section Card */
        .section-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
            border: 1px solid var(--card-border);
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
            width: 100%;
            overflow: hidden;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 28px;
            gap: 16px;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            transition: all 0.3s ease;
        }

        .section-header:hover .section-icon {
            transform: rotate(10deg) scale(1.1);
        }

        .section-title {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            flex: 1;
        }

        /* Modern Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: none;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-icon {
            width: 18px;
            height: 18px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 6px rgba(0, 200, 215, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 200, 215, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #0d9c6f);
            color: white;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #0d9c6f, var(--success));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #e6950a);
            color: white;
            box-shadow: 0 4px 6px rgba(245, 158, 11, 0.2);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e6950a, var(--warning));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #e03e3e);
            color: white;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #e03e3e, var(--danger));
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: rgba(0, 200, 215, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 200, 215, 0.1);
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 13px;
        }

        /* Button Ripple Effect */
        .btn-ripple {
            position: relative;
            overflow: hidden;
        }

        .btn-ripple-effect {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.7);
            transform: scale(0);
            animation: ripple 600ms linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Main Content Container */
        .main-content {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .nav-links {
                display: none;
            }
            
            .nav-search {
                margin: 0 10px;
            }
        }

        @media (max-width: 768px) {
            .top-nav {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            .nav-search {
                width: 100%;
                margin: 10px 0;
            }
            
            .section-card {
                padding: 16px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('layouts.sidebar')
    
    <div class="main">
        <!-- Top Navigation Bar -->
        <nav class="top-nav" id="topNav">
            <a href="{{ url('/') }}" class="nav-logo">
                <i class="fas fa-home"></i>
                <span>My App</span>
            </a>

            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('aboutus.index') }}" class="nav-link {{ request()->routeIs('aboutus.*') ? 'active' : '' }}">
                    <i class="fas fa-info-circle"></i>
                    <span>About Us</span>
                </a>
                <a href="{{ route('evenements.index') }}" class="nav-link {{ request()->routeIs('evenements.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Our Events</span>
                </a>
            </div>
        
            <div class="nav-search">
                <input type="text" class="search-input" placeholder="Search events...">
            </div>
            
            <div class="nav-user">
                <a href="{{ route('profile.edit') }}" class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </a>
            </div>
        </nav>

        <!-- Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('topNav');
            if (window.scrollY > 10) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Improved ripple effect that doesn't interfere with button functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Only add ripple to buttons with the btn-ripple class
            document.querySelectorAll('.btn-ripple').forEach(button => {
                button.addEventListener('click', function(e) {
                    // Don't prevent default behavior
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const ripple = document.createElement('span');
                    ripple.classList.add('btn-ripple-effect');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    
                    // Remove any existing ripples
                    const existingRipples = this.querySelectorAll('.btn-ripple-effect');
                    existingRipples.forEach(r => r.remove());
                    
                    this.appendChild(ripple);
                    
                    // Remove the ripple after animation completes
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>