<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Show all books to user with search
    public function index(Request $request)
    {
        $query = Book::query();

        // Search by title, author or genre
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('genre', 'like', "%{$search}%");
        }

        $books = $query->paginate(10);
        return view('user.books.index', compact('books'));
    }
}