<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // public function books()
    // {
    // return $this->belongsToMany(Author::class);
    // }

    public function books()
    {
        return $this->belongsToMany(Books::class, 'authors_books', 'author_id', 'book_id');
    }

}


