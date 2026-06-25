@extends('layouts.app')

@section('page-title', 'Manage Books')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-book"></i> All Books</h4>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Book
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                    <th>Total</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($book->cover_image)
                            <img src="{{ Storage::url($book->cover_image) }}"
                                 width="50" height="70"
                                 style="object-fit:cover; border-radius:4px;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                 style="width:50px;height:70px;border-radius:4px;font-size:10px;">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->author }}</td>
                    <td><span class="badge bg-info text-dark">{{ $book->genre }}</span></td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->total_copies }}</td>
                    <td>
                        @if($book->available_copies > 0)
                            <span class="badge bg-success">{{ $book->available_copies }}</span>
                        @else
                            <span class="badge bg-danger">0</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.books.edit', $book) }}"
                           class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.books.destroy', $book) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-1"></i>
                        <p>No books added yet!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection