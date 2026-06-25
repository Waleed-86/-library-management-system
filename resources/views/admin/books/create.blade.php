@extends('layouts.app')

@section('page-title', 'Add New Book')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Book</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="Enter book title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Author</label>
                            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                                   value="{{ old('author') }}" placeholder="Enter author name">
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">ISBN</label>
                            <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
                                   value="{{ old('isbn') }}" placeholder="Enter ISBN number">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Genre</label>
                            <input type="text" name="genre" class="form-control @error('genre') is-invalid @enderror"
                                   value="{{ old('genre') }}" placeholder="e.g. Fiction, Science">
                            @error('genre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Total Copies</label>
                            <input type="number" name="total_copies" class="form-control @error('total_copies') is-invalid @enderror"
                                   value="{{ old('total_copies') }}" placeholder="e.g. 5" min="1">
                            @error('total_copies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Available Copies</label>
                            <input type="number" name="available_copies" class="form-control @error('available_copies') is-invalid @enderror"
                                   value="{{ old('available_copies') }}" placeholder="e.g. 5" min="0">
                            @error('available_copies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Cover Image</label>
                            <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror"
                                   accept="image/*">
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Save Book
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection