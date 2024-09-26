<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'guest','as'=>'guest.'],function(){
    Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
        Route::get('/show',[ProfileController::class,'show'])->name('show');
        Route::get('/bookmark',[ProfileController::class,'bookmark'])->name('bookmark');
        Route::get('/order',[ProfileController::class,'order'])->name('order');
        Route::get('/comment',[ProfileController::class,'comment'])->name('comment');
        Route::get('/searchlist',[ProfileController::class,'searchlist'])->name('searchlist');
    });

    Route::get('/suggestion',[AuthorController::class, 'index']);

    Route::group(['prefix'=>'thread','as'=>'thread.'],function(){


        
    });




});


    Route::group(['prefix' => 'order', 'as' => 'order.'], function(){
        Route::get('/show', [BookController::class, 'show'])->name('show');
        Route::get('/upload', [HomeController::class, 'uploadImage'])->name('uploadImage');
    });


    Route::group(['prefix' => 'order', 'as' => 'order.'], function(){
        Route::get('/show', [BookController::class, 'show'])->name('show');
        Route::get('/confirm', [BookController::class, 'confirm'])->name('confirm');
    });

    Route::group(['prefix' => 'store', 'as' => 'store.'], function(){
        Route::get('/show', [StoreController::class, 'newOrderConfirm'])->name('newOrderConfirm');
    });
});


