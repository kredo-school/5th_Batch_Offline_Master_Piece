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



class BookController extends Controller
{
    private $book;
    private $author;
    private $store;
    public function __construct(Book $book, Author $author, User $store)
    {
        $this->book = $book;
        $this->author = $author;
        $this->store = $store;
    }

    public function show()
    {
       //
    }

    public function confirm()
    {
        return view('users.guests.order.confirm');
    }

    public function reserved()
    {
        return view('users.guests.order.reserved');
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

    public function showBook($id)
    {
        $book = $this->book->findOrFail($id);
        return view('users.guests.book.show_book', compact('book'));
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
}
