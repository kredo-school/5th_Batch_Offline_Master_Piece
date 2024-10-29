<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ProfileCompleteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ログインしているか確認
        if (Auth::check()) {
            // プロフィールが未完了の場合、例外的にプロフィール入力ページを許可
            if (!Auth::user()->profile) {
                // `profile.store`および`profile.edit`などのルートはリダイレクト対象外にする
                if (!$request->routeIs('profile.store', 'profile.edit')) {
                    return redirect('/welcome');
                }
            }
        }
    
        return $next($request);
    }
}
