<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authors_books', 'author_id', 'book_id');
    }

    //suggestion index
    public function relatedBooks($id)
    {
        return $this->hasMany(Book::class)->where('genre_id', $this->genre_id);
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function bookmarks()
    {
    return $this->hasMany(Bookmark::class);
    }

    public function isBookmarked()
    {
        return $this->bookmarks()->where('guest_id', Auth::user()->id)->exists();
    }

    //authors_books との conection
    public function authors_books()
    {
        return $this->hasMany(AuthorBook::class);
    }

    public function histories()
    {
    return $this->hasMany(History::class);
    }

    public function stores()
    {
        return $this->belongsToMany(User::class, 'inventories', 'book_id', 'store_id')->withPivot('stock');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
