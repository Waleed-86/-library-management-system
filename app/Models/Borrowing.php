<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'book_request_id',
        'borrowed_date',
        'due_date',
        'returned_date',
        'fine',
        'status'
    ];

    // This borrowing belongs to one student
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // This borrowing belongs to one book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // This borrowing belongs to one request
    public function bookRequest()
    {
        return $this->belongsTo(BookRequest::class);
    }
}