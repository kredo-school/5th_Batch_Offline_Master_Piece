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



}
