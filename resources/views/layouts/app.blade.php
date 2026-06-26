<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #f0f2f5; }

        /* SIDEBAR */
        .sidebar {
            min-height: 100vh;
            width: 260px;
            min-width: 260px;
            background: linear-gradient(180deg, #1a1f36 0%, #2d3561 100%);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
        }
        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand h5 {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }
        .sidebar-brand small {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
        }
        .sidebar-section {
            padding: 16px 16px 8px;
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .sidebar a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 8px;
            margin: 2px 8px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .sidebar a.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102,126,234,0.4);
        }
        .sidebar a i { font-size: 1rem; width: 20px; }
        .sidebar-divider {
            border-color: rgba(255,255,255,0.1);
            margin: 8px 16px;
        }
        .sidebar-logout {
            padding: 8px;
        }
        .sidebar-logout button {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7);
            padding: 10px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .sidebar-logout button:hover {
            background: rgba(220,53,69,0.2);
            border-color: rgba(220,53,69,0.3);
            color: #ff6b6b;
        }

        /* MAIN CONTENT */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* TOP NAVBAR */
        .top-navbar {
            background: white;
            padding: 12px 24px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .top-navbar .page-title {
            font-weight: 600;
            color: #1a1f36;
            font-size: 1.1rem;
        }
        .user-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            padding: 8px 16px;
            border-radius: 50px;
            border: 1px solid #e9ecef;
        }
        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* PAGE CONTENT */
        .page-content { padding: 24px; }

        /* CARDS */
        .card {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06) !important;
        }
        .card-header {
            background: white !important;
            border-bottom: 1px solid #f0f2f5 !important;
            padding: 16px 20px !important;
            border-radius: 12px 12px 0 0 !important;
        }

        /* ALERTS */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 12px 16px;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        /* TABLES */
        .table th {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            border-bottom: 2px solid #f0f2f5;
        }
        .table td { vertical-align: middle; }
        .table-hover tbody tr:hover { background: #f8f9ff; }

        /* BUTTONS */
        .btn { border-radius: 8px; font-size: 0.85rem; font-weight: 500; }
        .btn-primary { background: linear-gradient(135deg, #667eea, #764ba2); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #5a6fd8, #6a4190); border: none; }

        /* STATS CARDS */
        .stat-card {
            border-radius: 12px;
            padding: 24px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            right: -20px;
            top: -20px;
        }
        .stat-card-1 { background: linear-gradient(135deg, #667eea, #764ba2); }
        .stat-card-2 { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .stat-card-3 { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .stat-card-4 { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .stat-card h2 { font-size: 2rem; font-weight: 700; margin: 8px 0 4px; }
        .stat-card p { margin: 0; opacity: 0.85; font-size: 0.9rem; }
        .stat-card i { font-size: 1.5rem; opacity: 0.85; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-book-half text-primary" style="font-size:1.4rem;"></i>
                <h5>Library System</h5>
            </div>
            <small>Management Portal</small>
        </div>

        @auth
            @if(auth()->user()->is_admin)
                <div class="sidebar-section">Admin Panel</div>
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('admin.books.index') }}"
                   class="{{ request()->routeIs('admin.books*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> Manage Books
                </a>
                <a href="{{ route('admin.requests.index') }}"
                   class="{{ request()->routeIs('admin.requests*') ? 'active' : '' }}">
                    <i class="bi bi-inbox"></i> Book Requests
                    @php
                        $pendingCount = \App\Models\BookRequest::where('status','pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="badge bg-danger ms-auto">{{ $pendingCount }}</span>
                    @endif
                </a>
            @else
                <div class="sidebar-section">Student Panel</div>
                <a href="{{ route('user.books.index') }}"
                   class="{{ request()->routeIs('user.books*') ? 'active' : '' }}">
                    <i class="bi bi-search"></i> Browse Books
                </a>
                <a href="{{ route('user.my-requests') }}"
                   class="{{ request()->routeIs('user.my-requests') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i> My Requests
                </a>
                <a href="{{ route('user.history') }}"
                   class="{{ request()->routeIs('user.history') ? 'active' : '' }}">
                    <i class="bi bi-journal-check"></i> Borrow History
                </a>
            @endif

            <hr class="sidebar-divider">

            <div class="sidebar-logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper flex-grow-1">
        <!-- TOP NAVBAR -->
        <div class="top-navbar">
            <span class="page-title">
                <i class="bi bi-chevron-right text-muted me-1" style="font-size:0.8rem;"></i>
                @yield('page-title', 'Dashboard')
            </span>
            @auth
            <div class="user-badge">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-size:0.85rem; font-weight:600; color:#1a1f36;">
                        {{ auth()->user()->name }}
                    </div>
                    <div style="font-size:0.75rem; color:#6b7280;">
                        {{ auth()->user()->is_admin ? 'Administrator' : 'Student' }}
                    </div>
                </div>
                @if(auth()->user()->is_admin)
                    <span class="badge" style="background:linear-gradient(135deg,#667eea,#764ba2);">Admin</span>
                @else
                    <span class="badge bg-primary">Student</span>
                @endif
            </div>
            @endauth
        </div>

        <!-- PAGE CONTENT -->
        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>