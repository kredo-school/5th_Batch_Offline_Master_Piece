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

        $selected_genres = [];

        return view('users.guests.home',compact('suggestionedBooks','rankedBooks','newedBooks','threads','selected_genres'));
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
            // 購入履歴またはジャンル指定がない場合は、人気のある本を取得
            $suggestionedBooks = Book::with('authors')
                ->orderBy('books.publication_date', 'desc')
                ->limit(20)
                ->get();
        } else {
            // 購入履歴や選択ジャンルに基づく本の取得
            $suggestionedBooks = Book::whereIn('id', $purchasedBooks) // `books.id`の代わりに`id`
                ->with('authors')
                ->orderBy('books.publication_date', 'desc')
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
            ->select(
                'books.id',
                'books.title',
                'books.price',
                'books.image',
                DB::raw('GROUP_CONCAT(DISTINCT authors.name SEPARATOR ", ") as author_names'),
                DB::raw('AVG(reviews.star_count) as average_rating')
            )
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image')
            ->orderBy('average_rating', 'desc');

        // ジャンル指定があればフィルタリング
        if (!is_null($selected_genres)) {
            $query->whereIn('books.id', function ($subQuery) use ($selected_genres) {
                $subQuery->select('book_id')
                    ->from('genre_books')
                    ->whereIn('genre_id', $selected_genres);
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

        $query = Book::join('author_books', 'books.id', '=', 'author_books.book_id')
        ->join('authors', 'author_books.author_id', '=', 'authors.id')
        ->select('books.id', 'books.title', 'books.price', 'books.image', DB::raw('GROUP_CONCAT(authors.name SEPARATOR ", ") as author_name'))
        ->groupBy('books.id', 'books.title', 'books.price', 'books.image')
        ->orderBy('publication_date', 'desc');

    // ジャンル指定があればフィルタリング
    if (!is_null($selected_genres)) {
        $query->whereIn('books.id', function ($subQuery) use ($selected_genres) {
            $subQuery->select('book_id')
                ->from('genre_books')
                ->whereIn('genre_id', $selected_genres);
        });
    }

    return $query->limit(20)->get();
    }

    /**
     * ジャンルホーム画面の処理
     */
    public function genreHome(Request $request)
    {
        if ($request->isMethod('get')) {
            // GETリクエストでアクセスされた場合、別のページにリダイレクトする
            return redirect()->route('home'); // 適切なフォームページにリダイレクト
        }

        $request->validate([
            'genres' => 'required|array',
        ]);

        // ジャンルに基づいた本を取得
        $selected_genres = $request->genres;
        $suggestionedBooks = $this->bookSuggestion($selected_genres);
        $rankedBooks = $this->bookRanking($selected_genres);
        $newedBooks = $this->bookNew($selected_genres);
        $threads = Thread::latest()->limit(5)->get();

        return view('users.guests.home', compact('suggestionedBooks', 'rankedBooks', 'newedBooks','threads','selected_genres'));
    }

    public function genreHomeFromFooter($genre_id)
    {
        $selected_genres[] = $genre_id;
        $suggestionedBooks = $this->bookSuggestion($selected_genres);
        $rankedBooks = $this->bookRanking($selected_genres);
        $newedBooks = $this->bookNew($selected_genres);
        $threads = Thread::latest()->limit(5)->get();

        return view('users.guests.home', compact('suggestionedBooks', 'rankedBooks', 'newedBooks','threads','selected_genres'));
    }
}
