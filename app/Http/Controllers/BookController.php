<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

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


    // show list
    public function bookSuggestion()
    {
        return view('users.guests.book.suggestion');
    }

    public function bookRanking()
    {
        return view('users.guests.book.ranking');
    }

    public function bookNew()
    {
        return view('users.guests.book.new');
    }

    //
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
