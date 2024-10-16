<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;


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
        $store = Auth::user();

        $prefectures = [
            'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama',
            'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka',
            'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama',
            'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita',
            'Miyazaki', 'Kagoshima', 'Okinawa'
        ];

        return view('users.store.analysis.analysis',compact('store','prefectures'));
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

    public function getBookStock($book_id)
    {
        // $user = Auth::user();
        // $book = Book::with(['stores' => function ($query) use ($user) {
        //     $query->where('id', $user->id);
        // }])->find($book_id);
        // return view('users.store.books.book-information', compact('book'));
        $book = Book::with('stores')->find($book_id); // stores リレーションをロード
    return view('users.store.books.book-information', compact('book'));
    }
}
