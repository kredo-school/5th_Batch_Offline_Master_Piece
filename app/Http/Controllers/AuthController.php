<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        // dd('googleUser');
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        
        $googleUser = Socialite::driver('google')->user();
        
        $user = User::where('email', $googleUser->email)->first();
        
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => encrypt('123456dummy')  // ランダムなパスワードを生成
            ]);
        }

        Auth::login($user);

        return redirect()->route('home'); // HOME定数を使用してリダイレクト
    }
}





