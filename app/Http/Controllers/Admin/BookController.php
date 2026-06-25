<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Show all books
    public function index()
    {
        $books = Book::paginate(10); // Get 10 books per page
        return view('admin.books.index', compact('books'));
    }

    // Show form to add new book
    public function create()
    {
        return view('admin.books.create');
    }

    // Save new book to database
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'isbn'             => 'required|string|unique:books',
            'genre'            => 'required|string|max:255',
            'total_copies'     => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle cover image upload
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // Save book to database
        Book::create([
            'title'            => $request->title,
            'author'           => $request->author,
            'isbn'             => $request->isbn,
            'genre'            => $request->genre,
            'total_copies'     => $request->total_copies,
            'available_copies' => $request->available_copies,
            'cover_image'      => $coverImagePath,
        ]);

        return redirect()->route('admin.books.index')
                        ->with('success', 'Book added successfully!');
    }

    // Show form to edit book
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    // Save edited book
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'isbn'             => 'required|string|unique:books,isbn,' . $book->id,
            'genre'            => 'required|string|max:255',
            'total_copies'     => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle new cover image
        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->cover_image = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update([
            'title'            => $request->title,
            'author'           => $request->author,
            'isbn'             => $request->isbn,
            'genre'            => $request->genre,
            'total_copies'     => $request->total_copies,
            'available_copies' => $request->available_copies,
            'cover_image'      => $book->cover_image,
        ]);

        return redirect()->route('admin.books.index')
                        ->with('success', 'Book updated successfully!');
    }

    // Delete book
    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();

        return redirect()->route('admin.books.index')
                        ->with('success', 'Book deleted successfully!');
    }
}