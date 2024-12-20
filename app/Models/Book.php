<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes; // 追加

class Book extends Model
{
    use HasFactory, SoftDeletes; // 追加

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'publication_date',
        'publisher',
        'isbn_code',
        'price',
        'image'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }

    public function authors_books()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'author_id', 'book_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_books', 'book_id', 'genre_id');
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
    public function authorBook()
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

    public function stores()
    {
        return $this->belongsToMany(User::class, 'inventories', 'book_id', 'store_id')->withPivot('stock');
    }

    public function store_book()
    {
        return $this->belongsToMany(User::class, 'store_book');
    }

    public function storeBooks()
    {
        return $this->hasMany(StoreBook::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function storeOrders()
    {
    return $this->hasMany(StoreOrder::class);
    }

    public function store()
    {
        return $this->belongsTo(User::class, 'store_id');
    }

    public function receipt_book()
    {
        return $this->belongsToMany(ReceiptBook::class, 'receipt_book', 'book_id', 'receipt_id')->withPivot('quantity');
    }
}
