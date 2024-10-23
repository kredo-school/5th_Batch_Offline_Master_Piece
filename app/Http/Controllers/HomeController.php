<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Author;
use App\Models\Thread;
use App\Models\Genre;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $genre;
    public function __construct(Genre $genre)
    {
        $this->middleware('auth');

        $this->genre = $genre;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // パラメータがないのでnullで対応
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

    /**
     * おすすめ本を取得するメソッド
     * @param array|null $selected_genres
     * @return Collection
     */
    public function bookSuggestion($selected_genres = null)
    {
        if (is_null($selected_genres)) {
            // ログインユーザーの購入履歴から取得
            $userId = Auth::id();
            $purchasedBooks = DB::table('reserves')
                ->where('guest_id', $userId)
                ->pluck('book_id')
                ->toArray();
        } else {
            // ジャンル指定があった場合、ジャンルに基づく本を取得
            $purchasedBooks = DB::table('genre_books')
                ->whereIn('genre_id', $selected_genres)
                ->pluck('book_id')
                ->toArray();
        }

        if (empty($purchasedBooks)) {
            // 購入履歴がない場合は人気のある本を取得
            $suggestionedBooks = Book::with('authors')
                ->orderBy('books.publication_date', 'desc')
                ->limit(20)
                ->get();
        } else {
            // 購入履歴や選択ジャンルに基づく本の取得
            $genres = DB::table('genre_books')
                ->whereIn('book_id', $purchasedBooks)
                ->pluck('genre_id')
                ->toArray();

            $suggestionedBooks = Book::whereIn('books.id', function($query) use ($genres) {
                $query->select('book_id')
                    ->from('genre_books')
                    ->whereIn('genre_id', $genres);
            })
            ->with('authors')
            ->orderBy('books.publication_date', 'desc')
            ->join('author_books', 'books.id', '=', 'author_books.book_id')
            ->join('authors', 'author_books.author_id', "=", 'authors.id')
            ->join('reviews', 'books.id', '=', 'reviews.book_id')
            ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name')
            ->orderBy('average_rating', 'desc')
            ->limit(20)
            ->get();
        }

        return $suggestionedBooks;
    }

    /**
     * ランキング本を取得するメソッド
     * @param array|null $selected_genres
     * @return Collection
     */
    public function bookRanking($selected_genres = null)
    {
        $query = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            ->join('author_books', 'books.id', '=', 'author_books.book_id')
            ->join('authors', 'author_books.author_id', '=', 'authors.id')
            ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name')
            ->orderBy('average_rating', 'desc');

        // ジャンル指定があればフィルタリング
        if (!is_null($selected_genres)) {
            $query->whereHas('genres', function($query) use ($selected_genres) {
                $query->whereIn('genres.id', $selected_genres);
            });
        }

        return $query->limit(20)->get();
    }

    /**
     * 新しい本を取得するメソッド
     * @param array|null $selected_genres
     * @return Collection
     */
    public function bookNew($selected_genres = null)
    {
        $query = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            ->join('author_books', 'books.id', '=', 'author_books.book_id')
            ->join('authors', 'author_books.author_id', '=', 'authors.id')
            ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name')
            ->orderBy('books.publication_date', 'desc');

        // ジャンル指定があればフィルタリング
        if (!is_null($selected_genres)) {
            $query->whereHas('genres', function($query) use ($selected_genres) {
                $query->whereIn('genres.id', $selected_genres);
            });
        }

        return $query->limit(20)->get();
    }

    /**
     * ジャンルホーム画面の処理
     */
    public function genreHome(Request $request)
    {
        $request->validate([
            'genres' => 'required|array',
        ]);

        // 選択されたジャンルを取得
        $selected_genres = $request->genres;

        // ジャンルに基づいた本を取得
        $suggestionedBooks = $this->bookSuggestion($selected_genres);
        $rankedBooks = $this->bookRanking($selected_genres);
        $newedBooks = $this->bookNew($selected_genres);
        $threads = Thread::latest()->limit(5)->get();

        // 結果をビューに渡して表示
        return view('users.guests.home', compact('suggestionedBooks', 'rankedBooks', 'newedBooks','threads'));
    }

}
