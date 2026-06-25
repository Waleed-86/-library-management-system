<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
        }
        .sidebar a {
            color: #bdc3c7;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 2px 0;
        }
        .sidebar a:hover { background: #34495e; color: white; }
        .sidebar .active { background: #3498db; color: white; }
        .sidebar h5 { color: white; padding: 20px; border-bottom: 1px solid #34495e; }
        .main-content { padding: 20px; }
        .navbar { background: white; border-bottom: 1px solid #dee2e6; }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar p-0" style="width: 250px; min-width: 250px;">
        <h5><i class="bi bi-book"></i> Library System</h5>

        @auth
            @if(auth()->user()->is_admin)
                {{-- ADMIN SIDEBAR --}}
                <div class="px-3">
                    <small class="text-muted">ADMIN PANEL</small>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> Manage Books
                </a>
                <a href="{{ route('admin.requests.index') }}" class="{{ request()->routeIs('admin.requests*') ? 'active' : '' }}">
                    <i class="bi bi-inbox"></i> Book Requests
                </a>
            @else
                {{-- USER SIDEBAR --}}
                <div class="px-3">
                    <small class="text-muted">USER PANEL</small>
                </div>
                <a href="{{ route('user.books.index') }}" class="{{ request()->routeIs('user.books*') ? 'active' : '' }}">
                    <i class="bi bi-search"></i> Browse Books
                </a>
                <a href="{{ route('user.my-requests') }}" class="{{ request()->routeIs('user.my-requests') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i> My Requests
                </a>
                <a href="{{ route('user.history') }}" class="{{ request()->routeIs('user.history') ? 'active' : '' }}">
                    <i class="bi bi-journal-check"></i> Borrow History
                </a>
            @endif

            <hr class="border-secondary">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link sidebar-link" style="color:#bdc3c7; text-decoration:none; padding: 10px 20px;">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        @endauth
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-grow-1">

        <!-- TOP NAVBAR -->
        <nav class="navbar px-4 py-2">
            <span class="fw-bold text-muted">@yield('page-title', 'Dashboard')</span>
            @auth
            <span class="ms-auto">
                <i class="bi bi-person-circle"></i>
                {{ auth()->user()->name }}
                @if(auth()->user()->is_admin)
                    <span class="badge bg-danger ms-1">Admin</span>
                @else
                    <span class="badge bg-primary ms-1">Student</span>
                @endif
            </span>
            @endauth
        </nav>

        <!-- SUCCESS / ERROR MESSAGES -->
        <div class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- PAGE CONTENT GOES HERE --}}
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>php artisan make:migration add_is_admin_to_users_table