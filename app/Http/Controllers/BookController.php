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
}
