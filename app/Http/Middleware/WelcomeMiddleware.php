<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // ユーザーがログインしているかどうか確認
        if (Auth::check()) {
            // プロフィールが登録済みの場合
            if (Auth::user()->profile) {
                return redirect('/guest/home');  // プロフィールが完了している場合、別のページにリダイレクト
            }
        }

        return $next($request); // プロフィールが完了していない場合のみ通過
    }
}