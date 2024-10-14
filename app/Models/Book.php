<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'discription',
        'publication_date',
        'publisher',
        'ispn_code',
        'price',
        'image'
    ];

    public function author()
    {
        return $this->belongsToMany(Author::class, 'author_books');
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

    //author_books との conection
    public function author_books()
    {
        return $this->belongsToMany(Author::class,'author_books');
    }


    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function genre_book()
    {

        return $this->belongsToMany(Genre::class, 'genre_books');
    }



}
