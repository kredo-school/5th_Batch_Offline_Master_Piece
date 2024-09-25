<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
        Route::get('/show',[ProfileController::class,'show'])->name('show');
        Route::get('/bookmark',[ProfileController::class,'bookmark'])->name('bookmark');
        Route::get('/order',[ProfileController::class,'order'])->name('order');
        Route::get('/comment',[ProfileController::class,'comment'])->name('comment');
        Route::get('/edit',[ProfileController::class,'edit'])->name(name: 'edit');
        Route::get('/welcome',[ProfileController::class,'welcome'])->name(name: 'welcome');
    });

    Route::get('/suggestion',[AuthorController::class, 'index']);

});






