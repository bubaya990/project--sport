<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
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
        }

        .nav-logo:hover {
            transform: scale(1.05);
        }

        .nav-search {
            flex: 1;
            max-width: 500px;
            margin: 0 20px;
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

        /* Main Content Container */
        .main-content {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Responsive */
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
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('layouts.sidebar')
    
    <div class="main">
        <!-- Top Navigation Bar -->
        <nav class="top-nav" id="topNav">
            <div class="nav-logo">My app</div>
        
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
    </script>
    @stack('scripts')
</body>
</html>