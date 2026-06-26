<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'isbn'             => 'required|string|unique:books',
            'genre'            => 'required|string|max:255',
            'total_copies'     => 'required|integer|min:1',
            // BUG FIX: available_copies cannot exceed total_copies
            'available_copies' => 'required|integer|min:0|lte:total_copies',
            'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

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

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'isbn'             => 'required|string|unique:books,isbn,'.$book->id,
            'genre'            => 'required|string|max:255',
            'total_copies'     => 'required|integer|min:1',
            // BUG FIX: available_copies cannot exceed total_copies
            'available_copies' => 'required|integer|min:0|lte:total_copies',
            'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->cover_image = $request->file('cover_image')
                                        ->store('covers', 'public');
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