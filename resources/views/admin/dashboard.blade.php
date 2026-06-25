@extends('layouts.app')

@section('page-title', 'Admin Dashboard')

@section('content')
<div class="row g-4">

    {{-- Total Books Card --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <i class="bi bi-book fs-1 text-primary"></i>
                <h3 class="mt-2">{{ $totalBooks }}</h3>
                <p class="text-muted mb-0">Total Books</p>
            </div>
        </div>
    </div>

    {{-- Pending Requests Card --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <i class="bi bi-clock fs-1 text-warning"></i>
                <h3 class="mt-2">{{ $pendingRequests }}</h3>
                <p class="text-muted mb-0">Pending Requests</p>
            </div>
        </div>
    </div>

    {{-- Active Borrowings Card --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <i class="bi bi-person-check fs-1 text-success"></i>
                <h3 class="mt-2">{{ $activeBorrowings }}</h3>
                <p class="text-muted mb-0">Active Borrowings</p>
            </div>
        </div>
    </div>

    {{-- Total Users Card --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <i class="bi bi-people fs-1 text-danger"></i>
                <h3 class="mt-2">{{ $totalUsers }}</h3>
                <p class="text-muted mb-0">Total Students</p>
            </div>
        </div>
    </div>

</div>

{{-- Recent Requests Table --}}
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-inbox"></i> Recent Book Requests</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Student</th>
                    <th>Book</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRequests as $request)
                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->book->title }}</td>
                    <td>
                        @if($request->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($request->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>{{ $request->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.requests.index') }}" class="btn btn-sm btn-outline-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No requests yet!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection