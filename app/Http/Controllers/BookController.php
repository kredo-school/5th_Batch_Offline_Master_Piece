<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;



class BookController extends Controller
{
    private $book;
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function show()
    {
        return view('users.guests.order.show');
    }

    public function confirm()
    {
        return view('users.guests.order.confirm');
    }

    public function reserved()
    {
        return view('users.guests.order.reserved');
    }


    // book suggestion
    public function bookSuggestion()
{
    $userId = Auth::id();
    $purchasedBooks = DB::table('reserves')
        ->where('guest_id', $userId)
        ->pluck('book_id')
        ->toArray();

    // Guestが以前購入した本のジャンルを取得
    $genres = DB::table('genre_books')
        ->whereIn('book_id', $purchasedBooks)
        ->join('genres', 'genre_books.genre_id', '=', 'genres.id')
        ->pluck('genres.id')
        ->toArray();

    // 購入履歴によるおすすめ本の取得
    $suggestionedBooks = Book::whereIn('books.id', function($query) use($genres) {
        $query->select('book_id')
              ->from('genre_books')
              ->whereIn('genre_id', $genres);
    })
    ->join('author_books', 'books.id', '=', 'author_books.book_id')
    ->join('authors', 'author_books.author_id', "=", 'authors.id')
    ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
    ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name') 
    ->orderBy('average_rating', 'desc')
    ->limit(20)
    ->get()
    ->toArray();

    return view('users.guests.book.suggestion', compact('suggestionedBooks'));
}


    // show list
    public function bookRanking()
    {
    $rankedBooks = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            // ピボットテーブルと著者テーブルを結合
            ->join('author_books', 'books.id', '=', 'author_books.book_id')
            ->join('authors', 'author_books.author_id', '=', 'authors.id')
            ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name') 
            ->orderBy('average_rating', 'desc')
            ->limit(20)
            ->get();

    return view('users.guests.book.ranking', compact('rankedBooks'));
    }

    public function bookNew()
    {
        return view('users.guests.book.new');
    }

    public function showBook()
    {
        return view('users.guests.book.show_book');
    }

    public function bookInventory()
    {
        return view('users.guests.book.book_inventory');
    }

    public function authorShow()
    {
        return view('users.guests.book.show_author');
    }

    public function bookStoreShow()
    {
        return view('users.guests.show_store');
    }
    
    public function listStoreShow()
    {
        return view('users.guests.store_list');
    }


    public function find(Request $request)
    {
            $isbnCode = $request->input('isbn_code');
            $book = Book::where('isbn_code', $isbnCode)->first();

            if ($book) {
                return response()->json([
                    'title' => $book->title,
                    'price' => $book->price,
                ]);
            } else {
                return response()->json(['message' => 'Book not found'], 404);
            }
    }

}
