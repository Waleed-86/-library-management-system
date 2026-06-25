<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System — Register</title>
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
        .register-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .register-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-logo i {
            font-size: 50px;
            color: #3498db;
        }
        .btn-register {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
        }
        .btn-register:hover { opacity: 0.9; color: white; }
        .form-control {
            padding: 12px;
            border-radius: 8px;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52,152,219,0.25);
        }
    </style>
</head>
<body>
<div class="register-card">
    <div class="register-logo">
        <i class="bi bi-book-half"></i>
        <h4>Create Account</h4>
        <p class="text-muted small">Join the Library System</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Enter your full name" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}"
                       placeholder="Enter your email" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control"
                       placeholder="Enter password" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Confirm your password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-register mb-3">
            <i class="bi bi-person-plus"></i> Create Account
        </button>

        <div class="text-center">
            <span class="text-muted small">Already have an account?</span>
            <a href="{{ route('login') }}" class="small text-decoration-none ms-1 fw-bold">
                Sign in here
            </a>
        </div>
    </form>
</div>
</body>
</html>