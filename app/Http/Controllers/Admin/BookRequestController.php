<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    // Show all book requests
    public function index()
    {
        $requests = BookRequest::with(['user', 'book'])
                        ->latest()
                        ->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    // Approve a request
    public function approve(BookRequest $bookRequest)
    {
        // Check if already approved
        if ($bookRequest->status !== 'pending') {
            return redirect()->back()
                    ->with('error', 'This request has already been processed!');
        }

        // Check if book is available
        if ($bookRequest->book->available_copies <= 0) {
            return redirect()->back()
                    ->with('error', 'No copies available for this book!');
        }

        // Change status to approved
        $bookRequest->update(['status' => 'approved']);

        // Decrease available copies by 1
        $bookRequest->book->decrement('available_copies');

        // Create borrowing record
        Borrowing::create([
            'user_id'         => $bookRequest->user_id,
            'book_id'         => $bookRequest->book_id,
            'book_request_id' => $bookRequest->id,
            'borrowed_date'   => Carbon::today(),
            'due_date'        => Carbon::today()->addDays(7),
            'status'          => 'borrowed',
        ]);

        return redirect()->back()->with('success', 'Request approved successfully!');
    }

    // Reject a request
    public function reject(BookRequest $bookRequest)
    {
        // Check if already processed
        if ($bookRequest->status !== 'pending') {
            return redirect()->back()
                    ->with('error', 'This request has already been processed!');
        }

        $bookRequest->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Request rejected!');
    }

    // Mark book as returned + calculate fine
    public function markReturned(Borrowing $borrowing)
    {
        // Check if already returned
        if ($borrowing->status === 'returned') {
            return redirect()->back()
                    ->with('error', 'This book has already been returned!');
        }

        $today   = Carbon::today();
        $dueDate = Carbon::parse($borrowing->due_date);
        $fine    = 0;

        // Calculate fine if returned late
        if ($today->gt($dueDate)) {
            $daysLate = $today->diffInDays($dueDate);
            $fine     = $daysLate * 50; // Rs 50 per day
        }

        // Update borrowing record
        $borrowing->update([
            'returned_date' => $today,
            'fine'          => $fine,
            'status'        => 'returned',
        ]);

        // Increase available copies by 1
        $borrowing->book->increment('available_copies');

        return redirect()->back()
                ->with('success', "Book returned successfully! Fine: Rs {$fine}");
    }
}