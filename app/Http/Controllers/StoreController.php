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

    public function analysis(Request $request)
    {
        $store = Auth::user(); // 現在の店舗ユーザー

        // 1. ゲストのデータを取得 (都道府県別・男女別・年代別)
        $selectedPrefecture = $request->input('address', 'All Area');

        $guestsQuery = User::join('store_guest', 'users.id', '=', 'store_guest.guest_id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id') // profilesテーブルと結合
            ->where('store_guest.store_id', $store->id);

        // 都道府県フィルタが適用されている場合
        if ($selectedPrefecture !== 'All Area') {
            $guestsQuery->where('profiles.address', $selectedPrefecture); // profilesテーブルの住所を使用
        }

        $guests = $guestsQuery->select('profiles.gender', 'profiles.birthday')->get(); // profilesからgenderとbirthdayを取得

        // 年代別にグループ分けして集計
        $ageGroups = [
            '0~19' => ['male' => 0, 'female' => 0],
            '20~29' => ['male' => 0, 'female' => 0],
            '30~39' => ['male' => 0, 'female' => 0],
            '40~49' => ['male' => 0, 'female' => 0],
            '50~59' => ['male' => 0, 'female' => 0],
            '60~69' => ['male' => 0, 'female' => 0],
            '70~79' => ['male' => 0, 'female' => 0],
            '80~' => ['male' => 0, 'female' => 0]
        ];

        foreach ($guests as $guest) {
            $age = \Carbon\Carbon::parse($guest->birthday)->age;
            $gender = strtolower($guest->gender); // 'male' or 'female'

            if ($age < 20)
                $ageGroup = '0~19';
            elseif ($age < 30)
                $ageGroup = '20~29';
            elseif ($age < 40)
                $ageGroup = '30~39';
            elseif ($age < 50)
                $ageGroup = '40~49';
            elseif ($age < 60)
                $ageGroup = '50~59';
            elseif ($age < 70)
                $ageGroup = '60~69';
            elseif ($age < 80)
                $ageGroup = '70~79';
            else
                $ageGroup = '80~';

            $ageGroups[$ageGroup][$gender]++;
        }

        // 2. 本のデータを取得 (ジャンル別、タイトル別)
        $books = Book::join('store_book', 'books.id', '=', 'store_book.book_id')
            ->join('genre_books', 'books.id', '=', 'genre_books.book_id')
            ->join('genres', 'genre_books.genre_id', '=', 'genres.id')
            ->where('store_book.store_id', $store->id)
            ->select('books.title', 'genres.name as genre', \DB::raw('COUNT(books.id) as purchase_count'))
            ->groupBy('books.id', 'genres.name')
            ->orderBy('purchase_count', 'desc')
            ->take(10)
            ->get();

        $genres = [];
        foreach ($books as $book) {
            $genre = $book->genre;
            if (!isset($genres[$genre])) {
                $genres[$genre] = 0;
            }
            $genres[$genre] += $book->purchase_count;
        }

        $prefectures = [
            'Hokkaido',
            'Aomori',
            'Iwate',
            'Miyagi',
            'Akita',
            'Yamagata',
            'Fukushima',
            'Ibaraki',
            'Tochigi',
            'Gunma',
            'Saitama',
            'Chiba',
            'Tokyo',
            'Kanagawa',
            'Niigata',
            'Toyama',
            'Ishikawa',
            'Fukui',
            'Yamanashi',
            'Nagano',
            'Gifu',
            'Shizuoka',
            'Aichi',
            'Mie',
            'Shiga',
            'Kyoto',
            'Osaka',
            'Hyogo',
            'Nara',
            'Wakayama',
            'Tottori',
            'Shimane',
            'Okayama',
            'Hiroshima',
            'Yamaguchi',
            'Tokushima',
            'Kagawa',
            'Ehime',
            'Kochi',
            'Fukuoka',
            'Saga',
            'Nagasaki',
            'Kumamoto',
            'Oita',
            'Miyazaki',
            'Kagoshima',
            'Okinawa'
        ];

        return view('users.store.analysis.analysis', compact('store', 'prefectures', 'ageGroups', 'books', 'genres', 'selectedPrefecture'));
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
