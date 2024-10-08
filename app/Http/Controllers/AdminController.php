<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function addBook()
    {
        return view('admin.books.add');
    }

    public function guest()
    {
        return view('admin.guests.guest');
    }

    public function registerStore()
    {
        return view('admin.stores.register-store');
    }

    public function store()
    {
        return view('admin.stores.store');
    }

    public function genre()
    {
        return view('admin.genres.genre');
    }

    public function book()
    {
        return view('admin.books.book');
    }

    public function register()
    {
        return view('admin.stores.register-store');
    }
}
