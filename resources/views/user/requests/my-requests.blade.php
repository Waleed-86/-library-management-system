@extends('layouts.app')

@section('page-title', 'My Requests')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-clock-history"></i> My Book Requests</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Book</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Requested On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $request->book->title }}</strong></td>
                    <td>{{ $request->book->author }}</td>
                    <td>
                        @if($request->status == 'pending')
                            <span class="badge bg-warning">
                                <i class="bi bi-clock"></i> Pending
                            </span>
                        @elseif($request->status == 'approved')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Approved
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="bi bi-x-circle"></i> Rejected
                            </span>
                        @endif
                    </td>
                    <td>{{ $request->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-1"></i>
                        <p>You haven't requested any books yet!</p>
                        <a href="{{ route('user.books.index') }}" class="btn btn-primary">
                            Browse Books
                        </a>
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