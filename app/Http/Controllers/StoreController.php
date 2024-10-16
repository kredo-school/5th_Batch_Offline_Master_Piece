<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;


class StoreController extends Controller
{
    private $store;
    private $book;

    public function __construct(User $user, Book $book)
    {
        $this->store = $user;
        $this->book = $book;
    }

    public function newOrderConfirm()
    {
        return view('users.store.books.new-order-confirm');
    }

    public function orderConfirm()
    {
        return view('users.store.books.order-confirm');
    }

    public function ordered()
    {
        return view('users.store.books.ordered');
    }

    public function analysis()
    {
        return view('users.store.analysis.analysis');
    }

    public function reservationList()
    {
        return view('users.store.reservation.confirm-reservation-list');
    }

    public function reservationShow()
    {
        return view('users.store.reservation.confirm-reservation-show');
    }

    public function bookList()
    {
        return view('users.store.books.book-list');
    }

    public function home()
    {
        return view('users.store.home');
    }

    public function cashier()
    {
        return view('users.store.cashier.cashier');
    }

    public function receipt()
    {
        return view('users.store.cashier.receipt');
    }

    public function storeSearch()
    {
        return view('users.store.books.search');
    }

    public function inventory()
    {
        return view('users.store.books.inventory');
    }

    public function bookInformation($id)
    {
        $book = $this->book->findOrFail($id);
        return view('users.store.books.book-information')->with('book', $book);
    }
    public function profile()
    {
        return view('users.store.profile');
    }
    public function edit()
    {
        return view('users.store.edit');
    }
}
