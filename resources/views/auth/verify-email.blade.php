<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email — Library System</title>
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
        .verify-card {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        .email-icon-wrap {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        .btn-verify {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 500;
            width: 100%;
        }
        .btn-verify:hover { opacity: 0.9; color: white; }
    </style>
</head>
<body>
<div class="verify-card">
    <div class="email-icon-wrap">
        <i class="bi bi-envelope-check text-white" style="font-size: 40px;"></i>
    </div>

    <h4 class="fw-bold mb-2">Verify Your Email</h4>
    <p class="text-muted mb-4">
        We sent a verification link to your email address.
        Please check your inbox and click the link to activate your account.
    </p>

    @if(session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            <i class="bi bi-check-circle me-2"></i>
            A new verification link has been sent!
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-verify mb-3">
            <i class="bi bi-send me-2"></i> Resend Verification Email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-secondary btn-sm w-100">
            <i class="bi bi-box-arrow-left me-2"></i> Logout
        </button>
    </form>

    <div class="mt-4 p-3 bg-light rounded">
        <small class="text-muted">
            <i class="bi bi-info-circle me-1"></i>
            Check your spam folder if you don't see the email.
        </small>
    </div>
</div>
</body>
</html>