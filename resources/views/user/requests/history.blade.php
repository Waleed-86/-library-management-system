@extends('layouts.app')

@section('page-title', 'Borrow History')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-journal-check"></i> My Borrow History</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Book</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Returned Date</th>
                    <th>Fine</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $borrowing->book->title }}</strong></td>
                    <td>{{ $borrowing->borrowed_date }}</td>
                    <td>{{ $borrowing->due_date }}</td>
                    <td>{{ $borrowing->returned_date ?? '—' }}</td>
                    <td>
                        @if($borrowing->fine > 0)
                            <span class="badge bg-danger">Rs {{ $borrowing->fine }}</span>
                        @else
                            <span class="text-success">No Fine</span>
                        @endif
                    </td>
                    <td>
                        @if($borrowing->status == 'borrowed')
                            <span class="badge bg-warning">Borrowed</span>
                        @else
                            <span class="badge bg-success">Returned</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="bi bi-journal fs-1"></i>
                        <p>No borrowing history yet!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $borrowings->links() }}
        </div>
    </div>
</div>
@endsection