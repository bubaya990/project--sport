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
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--darker);
            color: var(--text);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Main Content */
        .main {
            flex-grow: 1;
            padding: 20px;
            background: linear-gradient(135deg, #1a2332 0%, #2d3748 50%, #374151 100%);
            min-height: 100vh;
            width: 100%;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            background: var(--secondary);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-logo {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
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
        }

        /* Section Card */
        .section-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
            border: 1px solid var(--card-border);
            backdrop-filter: blur(8px);
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
        }

        .section-title {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            flex: 1;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 200, 215, 0.3);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-warning {
            background: var(--warning);
            color: white;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 13px;
        }

        /* Events Grid */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .event-card {
            background: rgba(0, 140, 150, 0.1);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 140, 150, 0.2);
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 140, 150, 0.3);
            border-color: rgba(0, 140, 150, 0.4);
        }

        .event-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-image-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #008c96, #1a648c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .event-details {
            padding: 15px;
        }

        .event-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .event-date {
            font-size: 12px;
            color: #008c96;
            font-weight: 600;
        }

        .event-status {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        .status-scheduled {
            background: rgba(251, 191, 36, 0.2);
            color: #d97706;
        }

        .status-ongoing {
            background: rgba(16, 185, 129, 0.2);
            color: #059669;
        }

        .status-completed {
            background: rgba(239, 68, 68, 0.2);
            color: #dc2626;
        }

        .event-title {
            font-size: 16px;
            color: #ffffff;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .event-desc {
            font-size: 14px;
            color: #a0aec0;
            margin-bottom: 15px;
        }

        .event-actions {
            display: flex;
            gap: 10px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 30px;
            color: #a0aec0;
            background: rgba(0, 140, 150, 0.05);
            border-radius: 12px;
            margin-top: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .top-nav {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            .nav-search {
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('layouts.sidebar')
    
    <div class="main">
        <!-- Top Navigation Bar -->
        <nav class="top-nav">
            <div class="nav-logo">My app</div>
        
            <div class="nav-search">
                <input type="text" class="search-input" placeholder="Search events...">
            </div>
            
            <div class="nav-user">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>