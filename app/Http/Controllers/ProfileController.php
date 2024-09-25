<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

class ProfileController extends Controller
{
    //
    private $profile;

    public function __construct(User $user){
        $this->profile = $user;
    }


    public function show(){
        return view('guest.profile.show');
    }
    public function bookmark(){
        return view('guest.profile.bookmark');
    }
    public function order(){
        return view('guest.profile.order');
    }
    public function comment(){
        return view('guest.profile.comment');
    }

    public function searchlist(){
        return view('guest.profile.search-list');
    }


}
