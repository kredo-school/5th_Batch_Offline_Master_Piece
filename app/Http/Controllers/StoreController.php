<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Inventory;
use App\Models\Review;
use App\Models\StoreOrder;
use App\Models\Profile;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Reserve;





class StoreController extends Controller
{
    private $store;
    private $book;
    private $inventory;
    private $review;
    private $reserve;

    private $user;
    private $profile;

    public function __construct(User $user, Book $book, Inventory $inventory, Review $review, Profile $profile, Reserve $reserve)
    {
        $this->store = $user;
        $this->book = $book;
        $this->inventory = $inventory;
        $this->review = $review;
        $this->reserve = $reserve;

        $this->user = $user;
        $this->profile = $profile;
    }

    public function newOrderConfirm()
    {
        $user = Auth::user();
        return view('users.store.books.new-order-confirm', compact('user'));
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

        // もしゲストがいない場合は空の結果を設定
        if ($guests->isEmpty()) {
            $guests = collect(); // 空のコレクションをセットしてエラー回避
        }

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

        // データが存在しない場合は空の配列を設定
        $genres = [];
        if ($books->isNotEmpty()) {
            foreach ($books as $book) {
                $genre = $book->genre;
                if (!isset($genres[$genre])) {
                    $genres[$genre] = 0;
                }
                $genres[$genre] += $book->purchase_count;
            }
        }

        $prefectures = ['Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'];



        return view('users.store.analysis.analysis', compact('store', 'prefectures', 'ageGroups', 'books', 'genres', 'selectedPrefecture'));
    }




    public function reservationList()
    {
        $reservationNumber = [];
        return view('users.store.reservation.confirm-reservation-list')->with(compact('reservationNumber'));
    }

    public function reservationShow($reserve_id)
    {
        $reservation = $this->reserve->findOrFail($reserve_id);
        $reserves = $this->reserve->where('reservation_number', $reservation->reservation_number)->get();

        $total_price = 0;
        foreach($reserves as $reserve):
            $total_price += $reserve->book->price;
        endforeach;
        return view('users.store.reservation.confirm-reservation-show')->with(compact('reservation', 'reserves', 'total_price'));
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
        $all_inventories = $this->inventory->all();
        return view('users.store.books.inventory')->with(compact('all_inventories'));
    }

    public function bookInformation($id)
    {
        $book = $this->book->findOrFail($id);

        $reviews = $this->review
            ->where('book_id', $id)
            ->with('book')
            ->get();

        // Review Rating
        $ratingsCount = $book->reviews->count();

        $ratingsSummary = [
            '5_star' => $book->reviews()->where('star_count', 5)->count(),
            '4_star' => $book->reviews()->where('star_count', 4)->count(),
            '3_star' => $book->reviews()->where('star_count', 3)->count(),
            '2_star' => $book->reviews()->where('star_count', 2)->count(),
            '1_star' => $book->reviews()->where('star_count', 1)->count(),
        ];

        foreach ($ratingsSummary as $key => $count) {
            $ratingsSummary[$key] = $ratingsCount > 0 ? ($count / $ratingsCount) * 100 : 0;
        }

        return view('users.store.books.book-information', compact('book', 'reviews', 'ratingsSummary'));
    }

    public function addOrUpdateOrders(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        // リファラーURLの取得
        $referer = url()->previous();

        foreach ($validated['orders'] as $order) {
            $bookId = $order['book_id'];
            $quantity = $order['quantity'];

            // store_orders テーブルで該当のユーザーと book が存在するか確認
            $storeOrder = StoreOrder::where('user_id', $user->id)
                ->where('book_id', $bookId)
                ->first();

            if (str_contains($referer, '/store/new-confirm')) {
                if ($storeOrder) {
                    // 存在する場合は数量を更新
                    $storeOrder->quantity = $quantity;
                    $storeOrder->save();
                }
            } else {
                if ($storeOrder) {
                    // 存在する場合は数量を更新
                    $storeOrder->quantity += $quantity;
                    $storeOrder->save();
                } else {
                    // 存在しない場合は新規作成
                    StoreOrder::create([
                        'user_id' => $user->id,
                        'book_id' => $bookId,
                        'quantity' => $quantity,
                    ]);
                }
            }
        }


        // リダイレクト先の設定
        if (str_contains($referer, '/store/new-confirm')) {
            return redirect()->route('store.newOrderConfirm', compact('user'));
        } else {
            return redirect()->back()->with('success', 'Orders have been successfully updated.');
        }

    }

    public function deleteOrder($id)
    {
        $order = StoreOrder::findOrFail($id);

        $order->delete();
        return redirect()->back();
    }

    public function updateOrder(StoreOrderRequest $request)
    {
        $user_id = Auth::id();
        $validated = $request->validated();

        foreach ($validated['orders'] as $order) {
            $bookId = $order['book_id'];
            $quantity = $order['quantity'];

            // store_orders テーブルで該当のユーザーと book が存在するか確認
            $storeOrder = StoreOrder::where('user_id', $user_id)
                ->where('book_id', $bookId)
                ->first();

            if ($storeOrder) {
                // 存在する場合は数量を更新
                $storeOrder->quantity += $quantity;
                $storeOrder->save();
            } else {
                // 存在しない場合は新規作成
                StoreOrder::create([
                    'user_id' => $user_id,
                    'book_id' => $bookId,
                    'quantity' => $quantity,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Orders have been successfully updated.');
    }


    // ストアのプロフィール表示
    // public function profile()
    // {
    //     $store = Auth::user(); // もしくは `$this->store`を使用
    //     return view('users.store.profile', compact('store'));
    //     // return view('users.store.profile');
    // }
    public function profile()
{
    $store = Auth::user(); // ログインユーザー情報
    $profile = $store->profile; // Profile情報を取得
    

    return view('users.store.profile', compact('store', 'profile'));
}

    // ストアの編集ページ表示
    public function edit($id)
    {
        // 都道府県データ
        $prefectures = [
            'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita',
            'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma',
            'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata',
            'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano',
            'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga',
            'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama',
            'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi',
            'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka',
            'Saga', 'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki',
            'Kagoshima', 'Okinawa'
        ];
        
        // ユーザー情報を取得
        $store = User::with('profile')->findOrFail($id); // プロファイルも一緒に取得
        // $store = User::findOrFail($id);
        

        return view('users.store.edit', [
            'prefectures' => $prefectures,
            'store' => $store,
        ]);
    }

    // ストア情報の更新
    public function update(Request $request, $id)
{
    $store = User::with('profile')->findOrFail($id);

    // role_idが1または3でない場合は403エラーを返す
    // if (!in_array($store->role_id, [1,3])) {
    //     abort(403, 'Unauthorized action.');
    // }

    // プロファイルが存在しない場合は新規作成
    if (!$store->profile) {
        $store->profile()->create();
    }

    // バリデーション
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|digits_between:10,15',
        'prefecture' => 'required',
        'address' => 'required|string|max:255',
        'introduction' => 'required|string|max:5000',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1048'
    ]);

    // ユーザー情報の更新
    $store->name = $validated['name'];
    $store->email = $validated['email'];
    $store->save();

    // プロファイル情報の更新
    $store->profile->phone_number = $validated['phone'];
    $store->profile->introduction = $validated['introduction'];
    $store->profile->address = $validated['prefecture'] . ' / ' . $validated['address'];

    if ($request->hasFile('avatar')) {
        $store->profile->avatar = 'data:image/' . $validated['avatar']->extension() . ';base64,' . base64_encode(file_get_contents($validated['avatar']));
    }

    $store->profile->save();

    return back()->with('success', 'Store information has been changed.');
}
}


