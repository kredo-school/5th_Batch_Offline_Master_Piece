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

}
