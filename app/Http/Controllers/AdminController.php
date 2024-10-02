<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function create()
    {
        return view('admin.books.add');
    }    
    public function guest()
    {
        return view('admin.guest');
    }

    public function store()
    {
        return view('admin.stores.register-store');
        return view('admin.store');
    }

    public function genre()
    {
        return view('admin.genre');
    }

    public function book()
    {
        return view('admin.book');
    }
}
