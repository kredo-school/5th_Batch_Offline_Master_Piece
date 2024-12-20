<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Admin\GenresController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\GuestsController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\controllers\GuestOrderController;
use App\Http\controllers\LikeController;
use App\Http\controllers\EditController;
use App\Http\Controllers\ReserveController;
use App\Http\controllers\AuthController;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/policy', [HomeController::class, 'policy'])->name('policy');
    Route::get('/welcome', [ProfileController::class, 'welcome'])->name(name: 'welcome')->middleware('welcome');

    Route::group(['middleware' => 'profile'], function () {
        Route::group(['prefix' => 'guest'], function () {
            Route::get('/policy', [HomeController::class, 'policy'])->name('policy');
            Route::get('/home', [HomeController::class, 'index'])->name('home');
            Route::match(['get', 'post'], '/genrehome', [HomeController::class, 'genreHome'])->name('genreHome');
            Route::match(['get', 'post'], '/genrehome/fromfooter/{genre_id}', [HomeController::class, 'genreHomeFromFooter'])->name('genreHome.fromfooter');
            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('/{id}/show', [ProfileController::class, 'show'])->name('show');
                Route::get('/{id}/bookmark', [ProfileController::class, 'bookmark'])->name('bookmark');
                Route::get('/{id}/order', [ProfileController::class, 'order'])->name('order');
                Route::get('/{id}/comment', [ProfileController::class, 'comment'])->name('comment');
                Route::post('/store', [ProfileController::class, 'store'])->name('store');
                Route::get('/edit', [ProfileController::class, 'edit'])->name(name: 'edit');
                Route::patch('/update', [ProfileController::class, 'update'])->name(name: 'update');
                Route::get('/searchlist', [ProfileController::class, 'searchlist'])->name('searchlist');
                Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
                Route::get('{user_id}/comment/sort', [CommentController::class, 'sort'])->name('sort');
            });

            Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
                Route::get('/suggestion', [BookController::class, 'bookSuggestion'])->name('suggestion');
                Route::get('/ranking', [BookController::class, 'bookRanking'])->name('ranking');
                Route::get('/new', [BookController::class, 'bookNew'])->name('new');
                Route::get('/{id}/show/details', [BookController::class, 'showBook'])->name('show_book');
                Route::post('/{id}/review', [BookController::class, 'bookReview'])->name('review');
                Route::delete('/{id}/delete/review', [BookController::class, 'reviewDelete'])->name('review_delete');
                Route::post('/like/{review_id}/store', [LikeController::class, 'store'])->name('like.store');
                Route::delete('/like/{review_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');
                Route::get('/show/{id}/author', [BookController::class, 'authorShow'])->name('author_show');
                Route::get('/author/search', [BookController::class, 'searchAuthor'])->name('searchAuthor');
                Route::get('/{id}/inventory', [BookController::class, 'bookInventory'])->name('inventory');
                Route::get('/show/{id}/store', [BookController::class, 'bookStoreShow'])->name('store_show');
                Route::get('/list/store', [BookController::class, 'listStoreShow'])->name('store_list');
                Route::get('/search', [BookController::class, 'navSearch'])->name('search');
                Route::post('/reserve/{id}', [BookController::class, 'addReserved'])->name('reserve.add');

            });

            Route::get('/inquiry', [ProfileController::class, 'inquiry'])->name('inquiry');
            Route::post('/inquiry/send', [ProfileController::class, 'sendInquiry'])->name('inquiry.send');

        });

        Route::group(['prefix' => 'thread', 'as' => 'thread.'], function () {
            Route::get('/home', [ThreadController::class, 'home'])->name('home');
            Route::get('/content/{thread}', [ThreadController::class, 'content'])->name('content');
            Route::get('/create', [ThreadController::class, 'create'])->name('create');
            Route::post('/store', [ThreadController::class, 'store'])->name('store');
            Route::delete('/destroy/{thread}', [ThreadController::class, 'destroyThread'])->name('destroyThread');
            Route::post('/bookmark/{thread}', [ThreadController::class, 'bookmark'])->name('bookmark');
            Route::delete('/bookmark/{thread_id}', [ThreadController::class, 'bookmarkDestroy'])->name('bookmarkDestroy');
        });

        Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
            Route::post('/add-comment/{thread}', [CommentController::class, 'addComment'])->name('addComment');
            Route::delete('{id}/destroy', [CommentController::class, 'destroy'])->name('destroy');
            Route::post('/report/{comment}', [ReportController::class, 'report'])->name('report');
        });

        Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
            Route::get('/show', [GuestOrderController::class, 'show'])->name('show');
            Route::get('/confirm', [GuestOrderController::class, 'confirm'])->name('confirm')->middleware('guest-order');
            Route::get('/reserved/{reserved_ids}', [GuestOrderController::class, 'reserved'])->name('reserved');
            Route::patch('/update/delete', [GuestOrderController::class, 'updateAndDelete'])->name('updateAndDelete');
            Route::patch('/reserve', [GuestOrderController::class, 'reserve'])->name('reserve');
        });

        Route::group(['prefix' => 'store', 'as' => 'store.', 'middleware' => 'store'], function () {
            Route::get('/new-confirm', [StoreController::class, 'newOrderConfirm'])->name('newOrderConfirm');
            Route::get('/new-confirm/order', [OrderController::class, 'storeNewConfirmShow'])->name('storeNewConfirmShow');

            Route::get('/confirm', [StoreController::class, 'orderConfirm'])->name('orderConfirm');
            Route::patch('/ordered', [StoreController::class, 'ordered'])->name('ordered');

            Route::get('/analysis', [StoreController::class, 'analysis'])->name('analysis');
            Route::get('/confirm/reservation/list', [StoreController::class, 'reservationList'])->name('reservationList');
            Route::get('/confirm/reservation/show/{reserve_id}', [StoreController::class, 'reservationShow'])->name('reservationShow');
            Route::get('/book/list', [StoreController::class, 'bookList'])->name('bookList');
            Route::post('/book/list/add', [OrderController::class, 'addBookTOInventory'])->name('addBookTOInventory');

            Route::get('/inventory', [StoreController::class, 'inventory'])->name('inventory');
            // Route::get('/inventory/backend', [InventoryController::class, 'index'])->name('inventory.index');
        });

        Route::group(['prefix' => 'store', 'as' => 'store.', 'middleware' => 'store'], function () {
            // Route::get('/new-confirm', [OrderController::class, 'newOrderConfirm'])->name('newOrderConfirm');

            Route::get('/new-confirm/order', [OrderController::class, 'NewConfirmShow'])->name('NewConfirmShow');

            Route::post('/addToNewconfirm', [OrderController::class, 'addToNewconfirm'])->name('addToNewconfirm');
            Route::delete('/deleteOrder/{book_id}', [OrderController::class, 'deleteInventory'])->name('deleteInventory');

            // Route::patch('/updateAndDelete', [OrderController::class, 'updateAndDelete'])->name('updateAndDelete');
            Route::get('/home', [StoreController::class, 'home'])->name('home');
            Route::get('/cashier', [StoreController::class, 'cashier'])->name('cashier');
            Route::get('/receipt', [StoreController::class, 'receipt'])->name('receipt');
            Route::get('/book/information/{id}', [StoreController::class, 'bookInformation'])->name('bookInformation');
            Route::patch('/addOrUpdateOrders', [StoreController::class, 'addOrUpdateOrders'])->name('addOrUpdateOrders');
            Route::patch('/orders/update', [StoreController::class, 'updateOrders'])->name('updateOrders');
            Route::delete('/orders/{id}/destroy', [StoreController::class, 'deleteOrder'])->name('deleteOrder');

        Route::get('/search', [StoreController::class, 'storeSearch'])->name('search');
        Route::get('/receipt', [StoreController::class, 'getReceipt'])->name('getReceipt');
        Route::post('/checkout', [StoreController::class, 'checkout'])->name('checkout');
        Route::post('/reserve-books', [ReserveController::class, 'getBooksByReservationNumber']);


            // store edit周辺

            // Route::get('/profile',[StoreController::class,'profile'])->name('profile');
            // Route::get('/edit',[StoreController::class,'edit'])->name('edit');

            // ストアのプロフィール表示
            Route::get('/profile', [StoreController::class, 'profile'])->name('profile');

            // ストアの編集ページ表示
            Route::get('/{id}/edit', [StoreController::class, 'edit'])->name('edit')->middleware('edit');
            // Route::get('/{id}/edit', [StoreController::class, 'edit'])->name('edit');

            // ストア情報の更新
            Route::patch('/{id}', [StoreController::class, 'update'])->name('update');

            Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
            Route::post('/books/find', [BookController::class, 'findBook'])->name('books.find');
        });
    });

        Route::group(['prefix' => 'bookmark', 'as' => 'bookmark.'], function () {
            Route::post('/{book_id}/store', [BookmarkController::class, 'store'])->name('store');
            Route::delete('/{book_id}/destroy', [BookmarkController::class, 'destroy'])->name('destroy');
        });

        Route::get('/inventory', [StoreController::class, 'inventory'])->name('inventory');



    });

Route::group(['prefix' => 'bookmark', 'as' => 'bookmark.'], function () {
    Route::post('/{book_id}/store', [BookmarkController::class, 'store'])->name('store');
    Route::delete('/{book_id}/destroy', [BookmarkController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    // Genres
    Route::get('/genre/show', [GenresController::class, 'index'])->name('genres.show');
    Route::post('/genre/create', [GenresController::class, 'create'])->name('genres.create');
    Route::get('/genre/search', [GenresController::class, 'search'])->name('genres.search');
    Route::delete('/genre/{id}/destroy', [GenresController::class, 'destroy'])->name('genres.destroy');
    Route::post('/genre/{id}/restore', [GenresController::class, 'restore'])->name('genres.restore');

    // Books
    Route::post('/books/store', [BooksController::class, 'store'])->name('books.store');
    Route::get('/add-book', [BooksController::class, 'addBook'])->name('addBook');
    Route::get('/books/index', [BooksController::class, 'index'])->name('books.index');
    Route::delete('/books/{user}/destroy', [BooksController::class, 'destroy'])->name('books.destroy');
    Route::post('/books/{user}/restore', [BooksController::class, 'restore'])->name('books.restore');
    Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');


    //guests
    Route::delete('/guests/{user}/destroy', [GuestsController::class, 'destroy'])->name('guests.destroy');
    Route::post('/guests/{user}/restore', [GuestsController::class, 'restore'])->name('guests.restore');
    Route::get('/guests/index', [GuestsController::class, 'index'])->name('guests.index');
    Route::get('/guests/search', [GuestsController::class, 'search'])->name('guests.search');

    //stores
    Route::get('/stores/show', [StoresController::class, 'show'])->name('stores.show');

    Route::get('/stores/register', [StoresController::class, 'registerStore'])->name('registerStore');

    Route::delete('/stores/{user}/destroy', [StoresController::class, 'destroy'])->name('stores.destroy');
    Route::post('/stores/{user}/restore', [StoresController::class, 'restore'])->name('stores.restore');
    Route::get('/stores/search', [StoresController::class, 'search'])->name('stores.search');

    Route::post('/stores/register', [StoresController::class, 'register'])->name('stores.register');
    Route::get('/stores/list', [StoresController::class, 'show'])->name('stores.list');

    // reports
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('/index', [ReportsController::class, 'index'])->name('index');
        Route::get('/search', [ReportsController::class, 'search'])->name('search');
        Route::post('/store', [ReportsController::class, 'store'])->name('store');
        Route::delete('/reason/destroy/{reason}', [ReportsController::class, 'reasonDestroy'])->name('reason.destroy');
    });
});



Route::group(['prefix' => 'bookmark', 'as' => 'bookmark.'], function () {
    Route::post('/{book_id}/store', [BookmarkController::class, 'store'])->name('store');
    Route::delete('/{book_id}/destroy', [BookmarkController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home');

    // genres
    Route::get('/genre/show', [GenresController::class, 'index'])->name('genres.show');
    Route::post('/genre/create', [GenresController::class, 'create'])->name('genres.create');
    Route::get('/genre/search', [GenresController::class, 'search'])->name('genres.search');
    Route::delete('/genre/{id}/destroy', [GenresController::class, 'destroy'])->name('genres.destroy');
    Route::post('/genre/{id}/restore', [GenresController::class, 'restore'])->name('genres.restore');

    // Books
    Route::post('/books/store', [BooksController::class, 'store'])->name('books.store');
    Route::get('/add-book', [BooksController::class, 'addBook'])->name('addBook');
    Route::get('/books/index', [BooksController::class, 'index'])->name('books.index');
    Route::delete('/books/{user}/destroy', [BooksController::class, 'destroy'])->name('books.destroy');
    Route::post('/books/{user}/restore', [BooksController::class, 'restore'])->name('books.restore');
    Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');


    //guests
    Route::delete('/guests/{user}/destroy', [GuestsController::class, 'destroy'])->name('guests.destroy');
    Route::post('/guests/{user}/restore', [GuestsController::class, 'restore'])->name('guests.restore');
    Route::get('/guests/index', [GuestsController::class, 'index'])->name('guests.index');
    Route::get('/guests/search', [GuestsController::class, 'search'])->name('guests.search');

    //stores
    Route::get('/stores/show', [StoresController::class, 'show'])->name('stores.show');

    Route::get('/stores/register', [StoresController::class, 'registerStore'])->name('registerStore');

    Route::delete('/stores/{user}/destroy', [StoresController::class, 'destroy'])->name('stores.destroy');
    Route::post('/stores/{user}/restore', [StoresController::class, 'restore'])->name('stores.restore');
    Route::get('/stores/search', [StoresController::class, 'search'])->name('stores.search');

    Route::post('/stores/register', [StoresController::class, 'register'])->name('stores.register');
    Route::get('/stores/list', [StoresController::class, 'show'])->name('stores.list');



});

// ソーシャルログイン

Route :: get ( '/google/redirect' , [ App\Http\Controllers\AuthController :: class , 'redirectToGoogle' ])-> name ( 'google.redirect' );
Route :: get ( '/google/callback' , [ App\Http\Controllers\AuthController :: class , 'handleGoogleCallback' ])-> name ( 'google.callback' );




