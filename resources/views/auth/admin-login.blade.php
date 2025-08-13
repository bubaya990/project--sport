<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a2332 0%, #2d3748 50%, #374151 100%);
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            background: rgba(30, 41, 59, 0.7);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: #00c8d7;
            margin: 0;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #e2e8f0;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00c8d7;
            box-shadow: 0 0 0 2px rgba(0, 200, 215, 0.2);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .submit-btn {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #00c8d7, #0095a8);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #0095a8, #00c8d7);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 200, 215, 0.2);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #00c8d7;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Admin Login</h1>
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            @if($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="submit-btn">Login</button>
        </form>

        <a href="{{ url('/') }}" class="back-link">← Back to Home</a>
    </div>
</body>
</html>
