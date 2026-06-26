<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    // Request a book
    public function store(Request $request)
    {
        // Validate book_id
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // Check if user already has 3 active requests
        $activeRequests = BookRequest::where('user_id', Auth::id())
                            ->whereIn('status', ['pending', 'approved'])
                            ->count();

        if ($activeRequests >= 3) {
            return redirect()->back()
                    ->with('error', 'You can only request maximum 3 books at a time!');
        }

        // Check if user already requested this book
        $alreadyRequested = BookRequest::where('user_id', Auth::id())
                                ->where('book_id', $request->book_id)
                                ->whereIn('status', ['pending', 'approved'])
                                ->exists();

        if ($alreadyRequested) {
            return redirect()->back()
                    ->with('error', 'You have already requested this book!');
        }

        // Check if book is available
        $book = \App\Models\Book::findOrFail($request->book_id);
        if ($book->available_copies <= 0) {
            return redirect()->back()
                    ->with('error', 'Sorry! This book is not available right now!');
        }

        // Create the request
        BookRequest::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'status'  => 'pending',
        ]);

        return redirect()->back()
                ->with('success', 'Book requested successfully! Please wait for admin approval.');
    }

    // Show my requests
    public function myRequests()
    {
        $requests = BookRequest::with('book')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->paginate(10);

        return view('user.requests.my-requests', compact('requests'));
    }

    // Show borrowed books history
    public function history()
    {
        $borrowings = Borrowing::with('book')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->paginate(10);

        return view('user.requests.history', compact('borrowings'));
    }
}