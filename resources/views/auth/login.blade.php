<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #1a1f36 0%, #2d3561 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 45px 40px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        }
        .brand-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(102,126,234,0.4);
        }
        .brand-logo i { font-size: 32px; color: white; }
        .login-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-title h4 {
            font-weight: 700;
            color: #1a1f36;
            margin-bottom: 4px;
        }
        .login-title p { color: #6b7280; font-size: 0.9rem; }
        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
            margin-bottom: 6px;
        }
        .input-group-text {
            background: #f9fafb;
            border-right: none;
            border-color: #e5e7eb;
            color: #9ca3af;
        }
        .form-control {
            border-left: none;
            border-color: #e5e7eb;
            padding: 11px 14px;
            font-size: 0.9rem;
            background: #f9fafb;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: none;
            background: white;
        }
        .form-control:focus + .input-group-text,
        .input-group:focus-within .input-group-text {
            border-color: #667eea;
            background: white;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(102,126,234,0.4);
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(102,126,234,0.5);
            color: white;
        }
        .divider {
            text-align: center;
            color: #9ca3af;
            font-size: 0.85rem;
            margin: 20px 0;
            position: relative;
        }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 42%;
            height: 1px;
            background: #e5e7eb;
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }
        .register-link {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
        }
        .register-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }
        .alert {
            border: none;
            border-radius: 10px;
            font-size: 0.875rem;
            padding: 10px 14px;
        }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .forgot-link {
            color: #667eea;
            font-size: 0.8rem;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; }
        .form-check-input:checked { background-color: #667eea; border-color: #667eea; }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-card">

        {{-- Logo --}}
        <div class="brand-logo">
            <i class="bi bi-book-half"></i>
        </div>

        {{-- Title --}}
        <div class="login-title">
            <h4>Welcome Back!</h4>
            <p>Sign in to Library Management System</p>
        </div>

        {{-- Alerts --}}
        @if(session('status'))
            <div class="alert alert-success mb-3">
                <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           placeholder="Enter your email"
                           required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Enter your password"
                           required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           name="remember"
                           id="remember">
                    <label class="form-check-label small text-muted" for="remember">
                        Remember me
                    </label>
                </div>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-login mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
            </button>

            <div class="divider">or</div>

            <div class="register-link">
                Don't have an account?
                <a href="{{ route('register') }}">Create one here</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>