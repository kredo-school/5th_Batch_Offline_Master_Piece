<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Inventory;

class StoreController extends Controller
{
    private $store;
    private $book;
    private $inventory;

    public function __construct(User $user, Book $book, Inventory $inventory)
    {
        $this->store = $user;
        $this->book = $book;
        $this->inventory = $inventory;
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
       // 1. Inventoryテーブルに存在するbook_idを取得
    $inventory_books = Inventory::pluck('book_id')->toArray(); // Inventory にある book_id を配列として取得

    // 2. Inventoryに存在しないbook_idの本を取得
    $all_books = Book::whereNotIn('id', $inventory_books)->get();

    // 3. 取得した本をビューに渡す
    return view('users.store.books.book-list')->with(compact('all_books'));
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
