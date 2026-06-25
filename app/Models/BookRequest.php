<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'status'
    ];

    // This request belongs to one student
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // This request belongs to one book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // This request can have one borrowing
    public function borrowing()
    {
        return $this->hasOne(Borrowing::class);
    }
}