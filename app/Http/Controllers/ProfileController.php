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
        return view('users.guests.profile.show');
    }
    public function bookmark(){
        return view('users.guests.profile.bookmark');
    }
    public function order(){
        return view('users.guests.profile.order');
    }
    public function comment(){
        return view('users.guests.profile.comment');
    }

    public function edit(){
        return view('users.guests.profile.edit');
    }
    public function welcome(){
        return view('users.guests.profile.welcome');
    }
    

    public function searchlist(){
        return view('users.guests.profile.search-list');
    }


}
