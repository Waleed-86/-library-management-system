@extends('layouts.app')

@section('page-title', 'Book Requests')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-inbox"></i> All Book Requests</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Book</th>
                    <th>Status</th>
                    <th>Requested On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                        @if($request->status == 'pending')
                            <form action="{{ route('admin.requests.approve', $request) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success">
                                    <i class="bi bi-check-circle"></i> Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.requests.reject', $request) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                            </form>
                        @elseif($request->status == 'approved' && $request->borrowing)
                            @if($request->borrowing->status == 'borrowed')
                                <form action="{{ route('admin.borrowings.return', $request->borrowing) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">
                                        <i class="bi bi-arrow-return-left"></i> Mark Returned
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">
                                    Returned on {{ $request->borrowing->returned_date }}
                                    @if($request->borrowing->fine > 0)
                                        <span class="badge bg-danger">Fine: Rs {{ $request->borrowing->fine }}</span>
                                    @endif
                                </span>
                            @endif
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-1"></i>
                        <p>No requests yet!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $requests->links() }}
        </div>
    </div>
</div>
@endsection