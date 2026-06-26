@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card stat-card-1">
            <i class="bi bi-book"></i>
            <h2>{{ $totalBooks }}</h2>
            <p>Total Books</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-card-2">
            <i class="bi bi-clock"></i>
            <h2>{{ $pendingRequests }}</h2>
            <p>Pending Requests</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-card-3">
            <i class="bi bi-person-check"></i>
            <h2>{{ $activeBorrowings }}</h2>
            <p>Active Borrowings</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-card-4">
            <i class="bi bi-people"></i>
            <h2>{{ $totalUsers }}</h2>
            <p>Total Students</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Recent Book Requests</h6>
        <a href="{{ route('admin.requests.index') }}" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Student</th>
                    <th>Book</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRequests as $request)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:0.8rem;font-weight:600;">
                                {{ strtoupper(substr($request->user->name, 0, 1)) }}
                            </div>
                            {{ $request->user->name }}
                        </div>
                    </td>
                    <td>{{ $request->book->title }}</td>
                    <td>
                        @if($request->status == 'pending')
                            <span class="badge rounded-pill" style="background:#fef3c7;color:#92400e;">⏳ Pending</span>
                        @elseif($request->status == 'approved')
                            <span class="badge rounded-pill" style="background:#d1fae5;color:#065f46;">✅ Approved</span>
                        @else
                            <span class="badge rounded-pill" style="background:#fee2e2;color:#991b1b;">❌ Rejected</span>
                        @endif
                    </td>
                    <td class="text-muted">{{ $request->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.requests.index') }}" class="btn btn-sm btn-outline-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        No requests yet!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection