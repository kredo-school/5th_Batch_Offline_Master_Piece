<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Bookmark;




class BookController extends Controller
{
    private $book;
    private $author;
    private $review;
    private $user;
    private $store;

    public function __construct(Book $book, Author $author, Review $review, User $user, Bookmark $bookmark, User $store)
    {
        $this->book = $book;
        $this->author = $author;
        $this->review = $review;
        $this->user  = $user;
        $this->bookmark = $bookmark;
        $this->store = $store;
    }

    public function show()
    {
       //
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
            $suggestionedBooks = Book::whereIn('books.id', function ($query) use ($genres) {
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

        return view('users.guests.book.suggestion', compact('suggestionedBooks'));
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

        return view('users.guests.book.ranking', compact('rankedBooks'));
    }

    public function bookNew()
    {
        $newedBooks = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            ->join('author_books', 'books.id', '=', 'author_books.book_id')
            ->join('authors', 'author_books.author_id', '=', 'authors.id')
            ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name')
            ->orderBy('books.publication_date', 'desc')
            ->limit(20)
            ->get();

    return view('users.guests.book.new', compact('newedBooks'));
    }


    public function showBook(Request $request ,$id)
    {
        $book = $this->book->findOrFail($id);

        $reviews = $this->review
            ->where('book_id', $id)
            ->with('book')
            ->get();
        
        $prefectures = [
            'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama',
            'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka',
            'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama',
            'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita',
            'Miyazaki', 'Kagoshima', 'Okinawa'
        ];

        
        $sort = $request->get('sort', 'created_at');

        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'highest-rating':
                    $reviews->orderBy('star_count', 'desc'); 
                    break;
                case 'lowest-rating':
                    $reviews->orderBy('star_count', 'asc'); 
                    break;
                default: 
                    $reviews->orderBy('created_at', 'desc');
                    break;
            }
        }
        
        // Suggestion
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
        // Same Genre
            $sameGenreBooks = $this->book
                    ->with('genres')
                    ->orderBy('books.publication_date', 'desc')
                    ->limit(20)
                    ->get();

        // Review Rating
        $ratingsCount = $book->reviews->count();

        $ratingsSummary = [
            '5_star' => $book->reviews()->where('star_count', 5)->count(),
            '4_star' => $book->reviews()->where('star_count', 4)->count(),
            '3_star' => $book->reviews()->where('star_count', 3)->count(),
            '2_star' => $book->reviews()->where('star_count', 2)->count(),
            '1_star' => $book->reviews()->where('star_count', 1)->count(),
        ];

        foreach ($ratingsSummary as $key => $count) {
            $ratingsSummary[$key] = $ratingsCount > 0 ? ($count / $ratingsCount) * 100 : 0;
        }

        return view('users.guests.book.show_book', compact('book','prefectures','suggestionedBooks','sameGenreBooks','reviews','ratingsSummary'));
    }

    public function bookReview(request $request, $id)
    {
        $request->validate([
            'review_title' => 'required|min:1|max:30',
            'review_content' => 'required|min:1|max:1000',
        ]);

        $book_id = $id;

        $this->review = new Review();

        $this->review->title = $request->review_title;
        $this->review->body  = $request->review_content;
        $this->review->guest_id = Auth::user()->id;
        $this->review->book_id  = $book_id;
        $this->review->star_count = $request->rating;

        $this->review->save();

        return redirect()->route('book.show_book', ['id' => $book_id]);
    }

        

    public function bookInventory()
    {
        return view('users.guests.book.book_inventory');
    }

    public function authorShow($id)
    {
        $author = $this->author->findOrFail($id);
        

        return view('users.guests.book.show_author',compact('author'));
    }

    public function searchAuthor(Request $request)
    {
        $search_authors = $this->author->where('name', 'like', '%'.$request->search.'%')->get();

        return view('users.guests.book.author_list',compact('search_authors','request'));

    }

    public function bookStoreShow($id)
    {
        $store = $this->store->findOrFail($id);
        $prefectures = ['Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'];

        return view('users.guests.show_store', compact('store', 'prefectures'));
    }

    public function listStoreShow(Request $request)
    {
        $area = $request->input('area');    // プルダウンで選択されたエリア
        $searchQuery = $request->input('search'); // 検索バーの検索内容

        // 初期のストア取得クエリ
        $query = $this->store->where('role_id', 3);

        // エリアフィルタリング
        if ($area && $area !== 'All') {
            $query->whereHas('profile', function ($query) use ($area) {
                $query->where('address', 'LIKE', '%' . $area . '%');
            });
        }

        // ストアのnameだけで検索
        if ($searchQuery) {
            $query->where('name', 'LIKE', '%' . $searchQuery . '%');
        }

        // フィルタ済みのストア取得
        $stores = $query->get();

        // 都道府県のリスト
        $prefectures = ['Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'];

        return view('users.guests.store_list', compact('stores', 'prefectures', 'area', 'searchQuery'));
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

    public function search(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $books = Book::where('title', 'LIKE', '%' . $query . '%')
                ->orWhereHas('authors', function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                })
                ->orWhere('publisher', 'LIKE', '%' . $query . '%')
                ->orWhere('publication_date', 'LIKE', '%' . $query . '%')
                ->orWhere('isbn_code', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->get();
            $bookCount = $books->count();
        } else {
            $books = Book::all();
            $bookCount = $books->count();
        }

        return view('users.store.books.search')->with('books', $books)
            ->with('bookCount', $bookCount)
            ->with('searchQuery', $query);
    }

    public function navSearch(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $books = Book::where('title', 'LIKE', '%' . $query . '%')
                ->orWhereHas('authors', function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                })->get();
        } else {
            $books = Book::all();
        }

        return view('users.guests.book.search-list')->with('books', $books)
            ->with('searchQuery', $query);
    }
}




