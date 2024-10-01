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
        return view('users.store.new-order-confirm');
    }

    public function OrderConfirm()
    {
        return view('users.store.order-confirm');
    }

    public function Ordered()
    {
        return view('users.store.ordered');
    }

    public function analysis()
    {
        return view('users.store.analysis');
    }

    public function reservationList()
    {
        return view('users.store.confirm-reservation-list');
    }

    public function reservationShow()
    {
        return view('users.store.confirm-reservation-show');
    }

    public function bookList()
    {
        return view('users.store.book-list');
    }

    public function home()
    {
        return view('users.store.home');
    }

    public function cashier()
    {
        return view('users.store.cashier');
    }

    public function receipt()
    {
        return view('users.store.receipt');
    }
}
