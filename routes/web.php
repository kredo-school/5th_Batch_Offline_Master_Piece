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
use App\Http\controllers\GuestOrderController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/policy', [HomeController::class, 'policy'])->name('policy');
    Route::get('/welcome',[ProfileController::class,'welcome'])->name(name: 'welcome')->middleware('profile');
    Route::group(['prefix' => 'guest'], function () {
        Route::get('/policy', [HomeController::class, 'policy'])->name('policy');
        Route::get('/home/second', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
            Route::get('/{id}/show',[ProfileController::class,'show'])->name('show');
            Route::get('/{id}/bookmark',[ProfileController::class,'bookmark'])->name('bookmark');
            Route::get('/{id}/order',[ProfileController::class,'order'])->name('order');
            Route::get('/{id}/comment',[ProfileController::class,'comment'])->name('comment');
            Route::post('/store',[ProfileController::class,'store'])->name('store');
            Route::get('/edit',[ProfileController::class,'edit'])->name(name: 'edit');
            Route::patch('/update',[ProfileController::class,'update'])->name(name: 'update');
            Route::get('/searchlist',[ProfileController::class,'searchlist'])->name('searchlist');
        });

        Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
            Route::get('/suggestion', [BookController::class, 'bookSuggestion'])->name('suggestion');
            Route::get('/ranking', [BookController::class, 'bookRanking'])->name('ranking');
            Route::get('/new', [BookController::class, 'bookNew'])->name('new');
            Route::get('/{id}/show/details', [BookController::class, 'showBook'])->name('show_book');
            Route::post('/{id}/review', [BookController::class, 'bookReview'])->name('review');
            Route::get('/inventory', [BookController::class, 'bookInventory'])->name('inventory');
            Route::get('/show/{id}/author', [BookController::class, 'authorShow'])->name('author_show');
            Route::get('/show/{id}/store', [BookController::class, 'bookStoreShow'])->name('store_show');
            Route::get('/list/store', [BookController::class, 'listStoreShow'])->name('store_list');
        });
        
        Route::get('inquiry', [ProfileController::class, 'inquiry'])->name('inquiry');
    });

    Route::group(['prefix' => 'thread', 'as' => 'thread.'], function () {
        Route::get('/home', [ThreadController::class, 'home'])->name('home');
        Route::get('/content/{thread}', [ThreadController::class, 'content'])->name('content');
        Route::get('/create', [ThreadController::class, 'create'])->name('create');
        Route::post('/store', [ThreadController::class, 'store'])->name('store');
        Route::post('/add-comment/{thread}', [ThreadController::class, 'addComment'])->name('addComment');
        Route::delete('/comment/destroy/{comment}', [ThreadController::class, 'destroyComment'])->name('destroyComment');
        Route::delete('/destroy/{thread}', [ThreadController::class, 'destroyThread'])->name('destroyThread');
        Route::post('/report/{comment}', [ReportController::class, 'report'])->name('report');
    });

    Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
        Route::get('{user_id}/sort', [CommentController::class, 'sort'])->name('sort');
        Route::delete('{id}/destroy', [CommentController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/show', [GuestOrderController::class, 'show'])->name('show');
        Route::get('/confirm', [BookController::class, 'confirm'])->name('confirm');
        Route::get('/reserved', [GuestOrderController::class, 'reserved'])->name('reserved');
        Route::patch('/update/delete', [GuestOrderController::class, 'updateAndDelete'])->name('updateAndDelete');
    });

    Route::group(['prefix' => 'store', 'as' => 'store.','middleware' =>'store'], function () {
        Route::get('/new-confirm', [StoreController::class, 'newOrderConfirm'])->name('newOrderConfirm');
        Route::get('/new-confirm/order', [OrderController::class, 'storeNewConfirmShow'])->name('storeNewConfirmShow');

        Route::get('/confirm', [StoreController::class, 'orderConfirm'])->name('orderConfirm');
        Route::get('/ordered', [StoreController::class, 'ordered'])->name('ordered');
        Route::get('/analysis', [StoreController::class, 'analysis'])->name('analysis');
        Route::get('/confirm/reservation/list', [StoreController::class, 'reservationList'])->name('reservationList');
        Route::get('/confirm/reservation/show', [StoreController::class, 'reservationShow'])->name('reservationShow');
        Route::get('/book/list', [StoreController::class, 'bookList'])->name('bookList');
        Route::post('/book/list/add', [OrderController::class, 'addBookTOInventory'])->name('addBookTOInventory');
        
        Route::get('/inventory', [StoreController::class, 'inventory'])->name('inventory');
        // Route::get('/inventory/backend', [InventoryController::class, 'index'])->name('inventory.index');

        Route::get('/home', [StoreController::class, 'home'])->name('home');
        Route::get('/cashier', [StoreController::class, 'cashier'])->name('cashier');
        Route::get('/receipt', [StoreController::class, 'receipt'])->name('receipt');
        Route::get('/book/information/{id}',[StoreController::class, 'bookInformation'])->name('bookInformation');
        Route::get('/search', [StoreController::class, 'storeSearch'])->name('search');
        Route::get('/profile',[StoreController::class,'profile'])->name('profile');
        Route::get('/edit',[StoreController::class,'edit'])->name('edit');
        Route::post('/books/find', [BookController::class, 'find'])->name('books.find');
        Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
        });

        Route::group(['prefix' => 'bookmark','as' => 'bookmark.'],function(){
            Route::post('/{book_id}/store',[BookmarkController::class,'store'])->name('store');
            Route::delete('/{book_id}/destroy',[BookmarkController::class,'destroy'])->name('destroy');
        });



    });

    Route::group(['prefix' => 'bookmark','as' => 'bookmark.'],function(){
        Route::post('/{book_id}/store',[BookmarkController::class,'store'])->name('store');
        Route::delete('/{book_id}/destroy',[BookmarkController::class,'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware'=>'admin'], function () {
        Route::get('/home', [AdminController::class, 'index'])->name('home');
        Route::get('/store/register', [AdminController::class, 'registerStore'])->name('registerStore');
        Route::get('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/genre', [AdminController::class, 'genre'])->name('genre');
        Route::get('/guest', [AdminController::class, 'guest'])->name('guest');
        Route::get('/book', [AdminController::class, 'book'])->name('book');
        Route::get('/register', [AdminController::class, 'register'])->name('register');
        // genres
        Route::get('/genre/show',[GenresController::class,'index'])->name('genres.show');
        Route::post('/genre/create',[GenresController::class,'create'])->name('genres.create');
        Route::get('/genre/search',[GenresController::class,'search'])->name('genres.search');
        Route::delete('/genre/{id}/destroy',[GenresController::class,'destroy'])->name('genres.destroy');
        Route::post('/genre/{id}/restore',[GenresController::class,'restore'])->name('genres.restore');

        // Books
        Route::post('/books/store',[BooksController::class,'store'])->name('books.store');
        Route::get('/add-book', [BooksController::class, 'addBook'])->name('addBook');


});

