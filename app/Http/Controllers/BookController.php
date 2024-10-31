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
use App\Models\Reserve;
use App\Models\Inventory;
use App\Models\Like;
use App\Models\Genre;

class BookController extends Controller
{
    private $book;
    private $author;
    private $review;
    private $user;
    private $store;
    private $reserve;
    private $inventory;
    private $genre;

    public function __construct(Book $book, Author $author, Review $review, User $user, Bookmark $bookmark, User $store, Reserve $reserve, Inventory $inventory, Genre $genre)
    {
        $this->book = $book;
        $this->author = $author;
        $this->review = $review;
        $this->user  = $user;
        $this->bookmark = $bookmark;
        $this->store = $store;
        $this->inventory = $inventory;
        $this->genre = $genre;
    }

    public function bookSuggestion(Request $request)
    {
        $userId = Auth::id();
    
        // 購入済みの本のIDを取得
        $purchasedBooks = DB::table('reserves')
            ->where('guest_id', $userId)
            ->pluck('book_id')
            ->toArray();
    
        // 全ジャンルを取得
        $all_genres = $this->genre->all();
    
        // リクエストから選択されたジャンルIDを取得（nullの場合は "All genre" とみなす）
        $selectedGenreId = $request->input('genre');
    
        // クエリの準備
        $query = Book::with('authors', 'reviews');
    
        if ($selectedGenreId) {
            // 特定のジャンルが選ばれた場合、そのジャンルに属する本を取得
            $query->whereIn('books.id', function ($subQuery) use ($selectedGenreId) {
                $subQuery->select('book_id')
                    ->from('genre_books')
                    ->where('genre_id', $selectedGenreId);
            });
        } elseif (!empty($purchasedBooks)) {
            // 購入履歴がある場合、その履歴から関連するジャンルの本を取得
            $genres = DB::table('genre_books')
                ->whereIn('book_id', $purchasedBooks)
                ->pluck('genre_id')
                ->toArray();
    
            $query->whereIn('books.id', function ($subQuery) use ($genres) {
                $subQuery->select('book_id')
                    ->from('genre_books')
                    ->whereIn('genre_id', $genres);
            });
        } else {
            // 購入履歴がない場合、人気の本を新しい順に取得
            $query->orderBy('publication_date', 'desc');
        }
    
        // 本を最大20件取得
        $suggestedBooks = $query->limit(20)->get();
    
        // ビューにデータを渡す
        return view('users.guests.book.suggestion', compact('suggestedBooks','all_genres','selectedGenreId'));
    }
    




    public function bookRanking(Request $request)
    {
        $all_genres = $this->genre->all();
        
        // リクエストから選択されたジャンルIDを取得（nullの場合は "All genre" とみなす）
        $selectedGenreId = $request->input('genre');

        // 基本となるクエリを設定
        $query = Book::join('reviews', 'books.id', '=', 'reviews.book_id')
            ->join('author_books', 'books.id', '=', 'author_books.book_id')
            ->join('authors', 'author_books.author_id', '=', 'authors.id')
            ->select('books.id', 'books.title', 'books.price', 'books.image', 'authors.name as author_name', DB::raw('AVG(reviews.star_count) as average_rating'))
            ->groupBy('books.id', 'books.title', 'books.price', 'books.image', 'authors.name');

        if ($selectedGenreId) {
            // 特定のジャンルが選ばれた場合、そのジャンルに属する本を取得
            $query->whereIn('books.id', function ($subQuery) use ($selectedGenreId) {
                $subQuery->select('book_id')
                    ->from('genre_books')
                    ->where('genre_id', $selectedGenreId);
            });
        }

        // 評価順に並べ替え
        $rankedBooks = $query
            ->orderBy('average_rating', 'desc')
            ->limit(20)
            ->get();

        return view('users.guests.book.ranking', compact('rankedBooks', 'all_genres', 'selectedGenreId'));
    }


    public function bookNew(Request $request)
    {
        $all_genres = $this->genre->all();
    
        // リクエストから選択されたジャンルIDを取得（nullの場合は "All genre" とみなす）
        $selectedGenreId = $request->input('genre');

        $query = $this->book->with('authors', 'reviews');

        if ($selectedGenreId) {
            // 特定のジャンルが選ばれた場合、そのジャンルに属する本を取得
            $query->whereIn('books.id', function ($subQuery) use ($selectedGenreId) {
                $subQuery->select('book_id')
                    ->from('genre_books')
                    ->where('genre_id', $selectedGenreId);
            });

            $query->orderBy('publication_date', 'desc');
            
        } else {
            $query->orderBy('publication_date', 'desc');
        }

        $newedBooks = $query->limit(20)->get(); 
    
        return view('users.guests.book.new', compact('newedBooks','all_genres', 'selectedGenreId'));
    }


    public function showBook(Request $request ,$id)
    {
        $book = $this->book->findOrFail($id);

        $selectedPrefecture = $request->input('address', 'All Area');

        $storeLists = $this->user->where('role_id', 3)
        // 住所による絞り込み（'All Area'以外が選ばれた場合）
        ->when($selectedPrefecture !== 'All Area', function ($query) use ($selectedPrefecture) {
            $query->whereHas('profile', function ($query) use ($selectedPrefecture) {
                $query->where('address', $selectedPrefecture);
            });
        })
        // 関連するstoreBooksとそのbookを取得
        ->with(['inventories' => function ($query) {
            $query->with('book');
        }])
        ->get();


        $reviews = $this->review
            ->where('book_id', $id)
            ->with('book');
            
        
        $prefectures = [
            'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama',
            'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka',
            'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama',
            'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita',
            'Miyazaki', 'Kagoshima', 'Okinawa'
        ];

        
        $sort = $request->get('sort', 'created_at');

        switch ($sort) {
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

        // クエリを実行してデータを取得
        $reviews = $reviews->get();
        
        // Suggestion
        $userId = Auth::id();
    
        // 購入済みの本のIDを取得
        $purchasedBooks = DB::table('reserves')
            ->where('guest_id', $userId)
            ->pluck('book_id')
            ->toArray();
    
        // 全ジャンルを取得
        $all_genres = $this->genre->all();
    
        // リクエストから選択されたジャンルIDを取得（nullの場合は "All genre" とみなす）
        $selectedGenreId = $request->input('genre');
    
        // クエリの準備
        $query = Book::with('authors', 'reviews');
    
        if ($selectedGenreId) {
            // 特定のジャンルが選ばれた場合、そのジャンルに属する本を取得
            $query->whereIn('books.id', function ($subQuery) use ($selectedGenreId) {
                $subQuery->select('book_id')
                    ->from('genre_books')
                    ->where('genre_id', $selectedGenreId);
            });
        } elseif (!empty($purchasedBooks)) {
            // 購入履歴がある場合、その履歴から関連するジャンルの本を取得
            $genres = DB::table('genre_books')
                ->whereIn('book_id', $purchasedBooks)
                ->pluck('genre_id')
                ->toArray();
    
            $query->whereIn('books.id', function ($subQuery) use ($genres) {
                $subQuery->select('book_id')
                    ->from('genre_books')
                    ->whereIn('genre_id', $genres);
            });
        } else {
            // 購入履歴がない場合、人気の本を新しい順に取得
            $query->orderBy('publication_date', 'desc');
        }
    
        // 本を最大20件取得
        $suggestedBooks = $query->limit(20)->get();



        $sameGenreBooks = $this->book
        ->whereIn('books.id', function ($subQuery) use ($book) {
            $subQuery->select('book_id')
                ->from('genre_books')
                ->whereIn('genre_id', function ($genreSubQuery) use ($book) {
                    // 現在の本のジャンルを取得
                    $genreSubQuery->select('genre_id')
                        ->from('genre_books')
                        ->where('book_id', $book->id);
                });
        })
        ->with('genres') // ジャンル情報も取得
        ->orderBy('publication_date', 'desc') // 最新順に並べ替え
        ->limit(20) // 最大20件取得
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

        return view('users.guests.book.show_book', compact('book','prefectures','suggestedBooks','sameGenreBooks','reviews','ratingsSummary', 'selectedPrefecture'));
    }



    public function bookReview(request $request, $id)
    {
        $request->validate([
            'review_title' => 'required|min:1|max:30',
            'review_content' => 'required|min:1|max:1000',
            'star-rating' => 'required',
        ]);

        $book_id = $id;

        $this->review = new Review();

        $this->review->guest_id = Auth::user()->id;
        $this->review->title = $request->review_title;
        $this->review->body  = $request->review_content;
        $this->review->book_id  = $book_id;
        $this->review->star_count = $request->rating;

        $this->review->save();

        return redirect()->back();
    }

    public function reviewDelete($id)
    {
        $review = $this->review->findOrFail($id);
        $review->delete();
        

        return redirect()->back();
    }


    
    public function bookInventory(Request $request, $id)
    {
        $book = $this->book->findOrFail($id);

        // 選択された都道府県（デフォルトは "All Area"）
        $selectedPrefecture = $request->input('address', 'All Area');
        $searchQuery = $request->input('search', '');

        // 店舗リストのクエリ構築
        $storeLists = $this->user->where('role_id', 3)
        // 住所による絞り込み（'All Area'以外が選ばれた場合）
        ->when($selectedPrefecture !== 'All Area', function ($query) use ($selectedPrefecture) {
            $query->whereHas('profile', function ($query) use ($selectedPrefecture) {
                $query->where('address', $selectedPrefecture);
            });
        })
        // 店舗名の検索
        ->when($searchQuery, function ($query) use ($searchQuery) {
            return $query->where('name', 'LIKE', "%{$searchQuery}%");
        })
        // 関連するstoreBooksとそのbookを取得
        ->with(['inventories' => function ($query) {
            $query->with('book');
        }])
        ->get();


        // 都道府県リスト
        $prefectures = [
            'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma',
            'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano',
            'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori',
            'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga',
            'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'
        ];

        // store_id を取得
        $storeIds = $storeLists->pluck('id');


        $inventories = $this->inventory->where('book_id', $book->id)
            ->whereIn('store_id', $storeIds)
            ->get()
            ->keyBy('store_id');


        // ビューにデータを渡す
        return view('users.guests.book.book_inventory', compact(
            'book', 'prefectures', 'storeLists', 'inventories', 'selectedPrefecture', 'searchQuery'
        ));
    }


    


    public function addReserved(Request $request, $id)
    {
        // dd($request->all(), Auth::user());

        $request->validate([
            'store_ids' => 'required|array',
            'quantities' => 'required|array',

        ]);

        $book_id = $id;

        foreach ($request->store_ids as $storeId) {
            $amount = $request->quantities[$storeId] ?? 0;

            if ($amount > 0) {
                $reserve = new Reserve();
                $reserve->guest_id = Auth::user()->id;  
                $reserve->book_id = $book_id;
                $reserve->store_id = $storeId;
                $reserve->quantity = $amount;
                $reserve->reservation_number = null; 
                $reserve->save();  
            }
    
        }

        return redirect()->route('order.show')->with('success', 'Reservation successful!');
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




