<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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

        .login-container {
            width: 100%;
            max-width: 500px;
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.9), rgba(26, 35, 50, 0.95));
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 140, 150, 0.3);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
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

        .login-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .login-header h2 {
            font-size: 28px;
            margin: 0;
            color: white;
            position: relative;
            display: inline-block;
        }

        .login-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #008c96, #1a648c);
        }

        .login-header p {
            margin-top: 10px;
            color: #a0aec0;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #a0aec0;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: rgba(26, 35, 50, 0.8);
            border: 1px solid rgba(0, 140, 150, 0.3);
            border-radius: 8px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #008c96;
            box-shadow: 0 0 10px rgba(0, 140, 150, 0.3);
            background: rgba(26, 35, 50, 0.9);
        }

        .social-login {
            margin: 25px 0;
            text-align: center;
            position: relative;
        }

        .social-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(0, 140, 150, 0.3);
            z-index: 1;
        }

        .social-login span {
            position: relative;
            z-index: 2;
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.9), rgba(26, 35, 50, 0.95));
            padding: 0 15px;
            color: #a0aec0;
            font-size: 14px;
        }

        .social-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-btn.google {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-btn.google:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .social-btn.apple {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .social-btn.apple:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: translateY(-2px);
        }

        .social-icon {
            margin-right: 8px;
            width: 18px;
            height: 18px;
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
        }

        .btn-primary {
            background: linear-gradient(135deg, #008c96, #1a648c);
            color: white;
            margin-top: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 140, 150, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #a0aec0;
            font-size: 14px;
        }

        .register-link a {
            color: #008c96;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #1a648c;
            text-decoration: underline;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.2);
            border-left: 4px solid #ef4444;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            color: #fed7d7;
            font-size: 14px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .forgot-password a {
            color: #008c96;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Connexion</h2>
            <p>Accédez à votre compte</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Social Login Buttons -->
        <div class="social-buttons">
            <a href="{{ route('auth.google') }}" class="social-btn google">
                <svg class="social-icon" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Google
            </a>
            <a href="{{ route('auth.apple') }}" class="social-btn apple">
                <svg class="social-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                </svg>
                Apple
            </a>
        </div>

        <div class="social-login">
            <span>Ou connectez-vous avec votre email</span>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" required 
                       value="{{ old('email') }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" name="password" type="password" required 
                       class="form-control">
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div>
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Se connecter
            </button>
        </form>

        <div class="register-link">
            Vous n'avez pas de compte? <a href="{{ route('register') }}">S'inscrire</a>
        </div>
    </div>

    <script>
        // Simple animation for input focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.querySelector('label').style.color = '#008c96';
            });
            
            input.addEventListener('blur', function() {
                this.parentNode.querySelector('label').style.color = '#a0aec0';
            });
        });
    </script>
</body>
</html>
