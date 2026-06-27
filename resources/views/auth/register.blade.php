<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Library Management System</title>
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
            padding: 20px 0;
        }
        .register-wrapper {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }
        .register-card {
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
        .register-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-title h4 {
            font-weight: 700;
            color: #1a1f36;
            margin-bottom: 4px;
        }
        .register-title p { color: #6b7280; font-size: 0.9rem; }
        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
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
        .input-group:focus-within .input-group-text {
            border-color: #667eea;
            background: white;
        }
        .btn-register {
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
        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(102,126,234,0.5);
            color: white;
        }
        .login-link {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 16px;
        }
        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover { text-decoration: underline; }
        .alert {
            border: none;
            border-radius: 10px;
            font-size: 0.875rem;
            padding: 10px 14px;
        }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        .password-hint {
            font-size: 0.75rem;
            color: #9ca3af;
            margin-top: 4px;
        }
    </style>
</head>
<body>
<div class="register-wrapper">
    <div class="register-card">

        {{-- Logo --}}
        <div class="brand-logo">
            <i class="bi bi-book-half"></i>
        </div>

        {{-- Title --}}
        <div class="register-title">
            <h4>Create Account</h4>
            <p>Join the Library Management System</p>
        </div>

        {{-- Errors --}}
        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           placeholder="Enter your full name"
                           required autofocus>
                </div>
            </div>

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
                           required>
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
                           placeholder="Min 8 characters"
                           required>
                </div>
                <div class="password-hint">
                    <i class="bi bi-info-circle"></i>
                    Must be at least 8 characters
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Repeat your password"
                           required>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-person-plus me-2"></i> Create Account
            </button>

            <div class="login-link">
                Already have an account?
                <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>