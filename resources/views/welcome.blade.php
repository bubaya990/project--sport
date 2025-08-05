<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        <style>
            body { 
                margin: 0; 
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #0f1419 0%, #1a2332 50%, #2d3748 100%);
                color: #e2e8f0;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .welcome-container {
                width: 100%;
                max-width: 500px;
                background: linear-gradient(135deg, rgba(45, 55, 72, 0.9), rgba(26, 35, 50, 0.95));
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(0, 140, 150, 0.3);
                position: relative;
                overflow: hidden;
                text-align: center;
            }

            .welcome-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(0, 140, 150, 0.1), transparent);
                animation: headerGlow 3s ease-in-out infinite;
            }

            @keyframes headerGlow {
                0% { left: -100%; }
                100% { left: 100%; }
            }

            .welcome-header {
                text-align: center;
                margin-bottom: 30px;
                position: relative;
            }

            .welcome-header h2 {
                font-size: 28px;
                margin: 0;
                color: white;
                position: relative;
                display: inline-block;
            }

            .welcome-header h2::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 50px;
                height: 3px;
                background: linear-gradient(90deg, #008c96, #1a648c);
            }

            .welcome-header p {
                margin-top: 10px;
                color: #a0aec0;
                font-size: 14px;
            }

            .btn {
                width: 100%;
                padding: 14px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                margin: 10px 0;
                text-decoration: none;
                display: block;
            }

            .btn-primary {
                background: linear-gradient(135deg, #008c96, #1a648c);
                color: white;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 140, 150, 0.4);
            }

            .btn-secondary {
                background: rgba(255, 255, 255, 0.1);
                color: white;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: translateY(-2px);
            }

            .auth-buttons {
                margin-top: 30px;
            }

            .divider {
                margin: 20px 0;
                position: relative;
                text-align: center;
                color: #a0aec0;
            }

            .divider::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: rgba(0, 140, 150, 0.3);
                z-index: 1;
            }

            .divider span {
                position: relative;
                z-index: 2;
                background: linear-gradient(135deg, rgba(45, 55, 72, 0.9), rgba(26, 35, 50, 0.95));
                padding: 0 15px;
            }
        </style>
    </head>
    <body>
        <div class="welcome-container">
            <div class="welcome-header">
                <h2>Welcome to Our Platform</h2>
                <p>Join our community today</p>
            </div>

            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Log In
                </a>
                
                <div class="divider">
                    <span>or</span>
                </div>
                
                <a href="{{ route('register') }}" class="btn btn-secondary">
                    Create an Account
                </a>
            </div>
        </div>
    </body>
</html>