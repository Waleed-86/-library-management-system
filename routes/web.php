<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BookRequestController as AdminRequestController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\BookRequestController as UserRequestController;

// -------------------------------------------------------
// PUBLIC ROUTES
// -------------------------------------------------------
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.books.index');
    }
    return redirect()->route('login');
});

// -------------------------------------------------------
// AUTH ROUTES
// -------------------------------------------------------
require __DIR__.'/auth.php';

// -------------------------------------------------------
// USER ROUTES — Must be logged in + email verified
// -------------------------------------------------------
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/books', [UserBookController::class, 'index'])->name('books.index');
    Route::post('/books/request', [UserRequestController::class, 'store'])->name('books.request');
    Route::get('/my-requests', [UserRequestController::class, 'myRequests'])->name('my-requests');
    Route::get('/history', [UserRequestController::class, 'history'])->name('history');
});

// -------------------------------------------------------
// ADMIN ROUTES — Must be logged in + verified + admin
// -------------------------------------------------------
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalBooks'       => \App\Models\Book::count(),
            'pendingRequests'  => \App\Models\BookRequest::where('status', 'pending')->count(),
            'activeBorrowings' => \App\Models\Borrowing::where('status', 'borrowed')->count(),
            'totalUsers'       => \App\Models\User::where('is_admin', false)->count(),
            'recentRequests'   => \App\Models\BookRequest::with(['user', 'book'])->latest()->take(5)->get(),
        ]);
    })->name('dashboard');

    Route::resource('books', AdminBookController::class);

    Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests/{bookRequest}/approve', [AdminRequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{bookRequest}/reject', [AdminRequestController::class, 'reject'])->name('requests.reject');

    Route::post('/borrowings/{borrowing}/return', [AdminRequestController::class, 'markReturned'])->name('borrowings.return');
});