<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StoreController extends Controller
{
    private $store;

    public function __construct(User $user)
    {
        $this->store = $user;
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

    public function bookInformation()
    {
        return view('users.store.books.book-information');
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
