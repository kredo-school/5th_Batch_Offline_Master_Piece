<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\Thread;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $suggestionedBooks = $this->bookSuggestion();
        $rankedBooks = $this->bookRanking();
        $newedBooks = $this->bookNew();
        $threads = Thread::latest()->limit(5)->get();

        return view('users.guests.home',compact('suggestionedBooks','rankedBooks','newedBooks','threads'));
    }

    public function policy()
    {
        return view('policy');
    }

    public function bookSuggestion()
    {
        $userId = Auth::id();
        $purchasedBooks = DB::table('reserves')
            ->where('guest_id', $userId)
            ->pluck('book_id')
            ->toArray();

        // 購入履歴がない場合人気のある本を取得する
        if (empty($purchasedBooks)) {
            $suggestionedBooks = Book::with('authors')
                ->orderBy('books.publication_date', 'desc')
                ->limit(20)
                ->get();
        } else {
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
            ->join('reviews', 'books.id', '=', 'reviews.book_id')
            ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name') 
            ->orderBy('average_rating', 'desc')
            ->limit(20)
            ->get()
            ->toArray();
        }

        return $suggestionedBooks;
    }

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

    return $rankedBooks;
    }

    public function bookNew()
    {
        $newedBooks = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            ->join('author_books', 'books.id', '=', 'author_books.book_id')
            ->join('authors', 'author_books.author_id', '=', 'authors.id')
            ->select('books.id','books.title', 'books.price', 'books.image','authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id','books.title', 'books.price', 'books.image','authors.name')
            ->orderBy('books.publication_date', 'desc')
            ->limit(20)
            ->get();

        return $newedBooks;
    }
}
