<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    //
    private $profile;

    public function __construct(User $user){
        $this->profile = $user;

    }
}
