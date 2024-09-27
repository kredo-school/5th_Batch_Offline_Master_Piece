<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StoreController extends Controller
{
    private $store;

    public function __construct(User $user){
        $this->store = $user;
    }

    public function newOrderConfirm(){
        return view('users.store.new-order-confirm');
    }

    public function OrderConfirm(){
        return view('users.store.order-confirm');
    }
}
