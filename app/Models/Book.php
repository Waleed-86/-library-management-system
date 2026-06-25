<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // These fields can be saved to database
    protected $fillable = [
        'title',
        'author', 
        'isbn',
        'genre',
        'total_copies',
        'available_copies',
        'cover_image'
    ];

    // One book can have many requests
    public function bookRequests()
    {
        return $this->hasMany(BookRequest::class);
    }

    // One book can have many borrowings
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}