<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreGenreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{
    //

    private $book;
    private $author;
    private $genre;
    public function __construct(Book $book, Author $author, Genre $genre)
    {
        $this->book = $book;
        $this->author = $author;
        $this->genre = $genre;
    }

    public function addBook()
    {
        $all_genres = $this->genre->latest()->get();
        $all_authors = $this->author->latest()->get();

        return view('admin.books.add', compact('all_genres', 'all_authors'));


    }


    public function store(StoreBookRequest $storeBookRequest)
    {

        $validated = $storeBookRequest->validated();

        Log::info('Validated Data: ', context: $validated);

        DB::beginTransaction();  // トランザクション開始

        try {
            // Bookの保存
            $book = new Book();
            $book->title = $validated['title'];
            $book->description = $validated['description'];
            $book->publication_date = $validated['publication_date'];
            $book->price = $validated['price'];
            $book->publisher = $validated['publisher'];
            $book->isbn_code = $validated['isbn_code'];
            $book->price = $validated['price'];

            if (isset($validated['image'])) {
                $book->image = 'data:image/' . $validated['image']->extension() . ';base64,' . base64_encode(file_get_contents($validated['image']));
            }
            $book->save();// Book モデルを保存


            // 著者情報を取得（既存の場合はその著者データ、存在しない場合は新規作成）
            $author = $storeBookRequest->getAuthor();

            // 著者と書籍のピボットテーブルに保存
            $book->authors_books()->attach($author->id);

            // GenreとBookの関連付け (genre_bookテーブルにデータを挿入)
            foreach ($validated['genres'] as $genreId) {
                $book->genre_book()->attach($genreId);
            }

            DB::commit();  // トランザクションのコミット

            return redirect()->route('admin.addBook')->with('success', 'Book and related data saved successfully.');

        } catch (\Exception $e) {
            DB::rollBack();  // エラーが発生した場合、ロールバック

            Log::error($e->getMessage());

            // エラーメッセージを表示させたい場合
            return redirect()->route('admin.addBook')->with('error', 'Failed to save data: ' . $e->getMessage());
        }
    }

public function index(Request $request)
{
    // 検索条件とソート条件の取得
    $searchTerm = $request->input('search');
    $sort = $request->input('sort', 'publication_date'); // デフォルトでpublication_dateでソート
    $order = $request->input('order', 'desc'); // デフォルトで降順

    // クエリの初期化
    $query = Book::with(['authors', 'genres'])->withTrashed();

    // 検索条件があればクエリに適用
    if (!empty($searchTerm)) {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
              ->orWhereHas('authors', function ($query) use ($searchTerm) {
                  $query->where('name', 'LIKE', "%{$searchTerm}%");
              })
              ->orWhereHas('genres', function ($query) use ($searchTerm) {
                  $query->where('name', 'LIKE', "%{$searchTerm}%");
              });
        });
    }

    // ソートの適用
    if ($sort === 'status') {
        $query->orderByRaw('CASE WHEN deleted_at IS NULL THEN 0 ELSE 1 END ' . $order);
    } elseif ($sort === 'author') {
        $query->join('author_books', 'books.id', '=', 'author_books.book_id')
              ->join('authors', 'author_books.author_id', '=', 'authors.id')
              ->select('books.*')
              ->orderBy('authors.name', $order);
    // } elseif ($sort === 'genre') {
    //     $query->join('genre_books', 'books.id', '=', 'genre_books.book_id')
    //           ->join('genres', 'genre_books.genre_id', '=', 'genres.id')
    //           ->select('books.*')
    //           ->orderBy('genres.name', $order);
    } elseif ($sort === 'price') {
        $query->orderBy('price', $order);
    } elseif ($sort === 'title') {
        $query->orderBy('title', $order);
    } elseif ($sort === 'review') {
        $query->leftJoin('reviews', 'books.id', '=', 'reviews.book_id')
              ->select('books.*')
              ->groupBy('books.id')
              ->orderByRaw('AVG(reviews.star_count) ' . $order);
    } else {
        $query->orderBy('publication_date', $order);
    }

    // ページネーションの適用
    $books = $query->paginate(5);

    // ビューにデータを渡す
    return view('admin.books.book', compact('books', 'searchTerm'));
}

// タイトルとジャンル、著者は検索できてもいい





public function destroy($id)
{
    $book = $this->book->withTrashed()->find($id); // ソフトデリートを含めて書籍を取得

    if ($book) {
        $book->delete(); // ソフトデリート
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }

    return redirect()->route('admin.books.index')->with('error', 'Book not found.');
}

    public function restore($id)
{
    $book = Book::withTrashed()->find($id); // ソフトデリートされた書籍も取得

    if ($book) {
        $book->restore(); // 復元
        return redirect()->route('admin.books.index')->with('success', 'Book restored successfully.');
    }

    return redirect()->route('admin.books.index')->with('error', 'Book not found.');
}

public function search(Request $request)
{
    $searchTerm = $request->input('search');
    $sort = $request->input('sort', 'publication_date');
    $order = $request->input('order', 'asc');

    // クエリの初期化
    $query = Book::with(['authors', 'genres'])->withTrashed();

    // 検索条件があればクエリに適用
    if (!empty($searchTerm)) {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
              ->orWhereHas('authors', function ($query) use ($searchTerm) {
                  $query->where('name', 'LIKE', "%{$searchTerm}%"); // authorsテーブルのnameカラムで検索
              })
              ->orWhereHas('genres', function ($query) use ($searchTerm) {
                  $query->where('name', 'LIKE', "%{$searchTerm}%"); // genresテーブルのnameカラムで検索
              });
        });
    }

    // ソートの適用
    if ($sort === 'author') {
        // 著者名でソート
        $query->join('authors', 'books.author_id', '=', 'authors.id')
              ->select('books.*') // 書籍のカラムを選択
              ->orderBy('authors.name', $order);
    } elseif ($sort === 'genre') {
        // ジャンルでソート
        $query->with(['genres'])->orderBy('genres.name', $order);
    } else {
        // 通常のソート
        $query->orderBy($sort, $order);
    }

    // ページネーション
    $books = $query->paginate(5);

    // ビューにデータを渡す
    return view('admin.books.book', compact('books'));
}





}
