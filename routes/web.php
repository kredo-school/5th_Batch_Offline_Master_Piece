<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'order', 'as' => 'order.'], function(){
    Route::get('/show', [BookController::class, 'show'])->name('show');
    Route::get('/upload', [HomeController::class, 'uploadImage'])->name('uploadImage');
});
