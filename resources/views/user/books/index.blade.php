@extends('layouts.app')

@section('page-title', 'Browse Books')

@section('content')

{{-- Search Bar --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('user.books.index') }}">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-lg"
                       placeholder="Search by title, author or genre..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('user.books.index') }}" class="btn btn-outline-secondary">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Books Grid --}}
<div class="row g-4">
    @forelse($books as $book)
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            {{-- Book Cover --}}
            @if($book->cover_image)
                <img src="{{ Storage::url($book->cover_image) }}"
                     class="card-img-top" height="200"
                     style="object-fit:cover;">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                     style="height:200px;">
                    <i class="bi bi-book fs-1"></i>
                </div>
            @endif

            <div class="card-body">
                <h6 class="card-title fw-bold">{{ $book->title }}</h6>
                <p class="text-muted small mb-1">
                    <i class="bi bi-person"></i> {{ $book->author }}
                </p>
                <p class="text-muted small mb-2">
                    <span class="badge bg-info text-dark">{{ $book->genre }}</span>
                </p>

                {{-- Availability --}}
                @if($book->available_copies > 0)
                    <p class="text-success small mb-2">
                        <i class="bi bi-check-circle"></i>
                        {{ $book->available_copies }} copies available
                    </p>
                    {{-- Request Button --}}
                    <form action="{{ route('user.books.request') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-hand-index"></i> Request Book
                        </button>
                    </form>
                @else
                    <p class="text-danger small mb-2">
                        <i class="bi bi-x-circle"></i> Not available
                    </p>
                    <button class="btn btn-secondary btn-sm w-100" disabled>
                        Not Available
                    </button>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <i class="bi bi-search fs-1 text-muted"></i>
        <p class="text-muted mt-2">No books found!</p>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $books->links() }}
</div>
@endsection