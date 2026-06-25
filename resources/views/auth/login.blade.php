<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System — Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo i {
            font-size: 50px;
            color: #3498db;
        }
        .login-logo h4 {
            color: #2c3e50;
            font-weight: 700;
            margin-top: 10px;
        }
        .btn-login {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
        }
        .btn-login:hover {
            opacity: 0.9;
            color: white;
        }
        .form-control {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52,152,219,0.25);
        }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo">
        <i class="bi bi-book-half"></i>
        <h4>Library Management System</h4>
        <p class="text-muted small">Sign in to your account</p>
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}"
                       placeholder="Enter your email" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control"
                       placeholder="Enter your password" required>
            </div>
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label small" for="remember">Remember me</label>
            </div>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-decoration-none">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-login mb-3">
            <i class="bi bi-box-arrow-in-right"></i> Sign In
        </button>

        <div class="text-center">
            <span class="text-muted small">Don't have an account?</span>
            <a href="{{ route('register') }}" class="small text-decoration-none ms-1 fw-bold">
                Register here
            </a>
        </div>
    </form>
</div>
</body>
</html>