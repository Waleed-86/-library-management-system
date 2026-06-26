<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="min-vh-100 d-flex align-items-center justify-content-center">
    <div class="text-center">
        <i class="bi bi-shield-lock text-danger" style="font-size:80px;"></i>
        <h1 class="display-1 fw-bold text-danger">403</h1>
        <h3>Access Denied!</h3>
        <p class="text-muted">You don't have permission to access this page.</p>
        <a href="{{ url()->previous() }}" class="btn btn-danger me-2">
            <i class="bi bi-arrow-left"></i> Go Back
        </a>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary">
            <i class="bi bi-house"></i> Home
        </a>
    </div>
</div>
</body>
</html>