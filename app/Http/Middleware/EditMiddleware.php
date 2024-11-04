<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// class EditMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */

//     public function handle(Request $request, Closure $next, $roleId): Response
//     {
//         $user = Auth::user();

//         // URLのidパラメータを取得
//         $id = $request->route('id');

//         // role_idが3（一般ユーザー）の場合、自分のid以外のアクセスを拒否
//         if ($user->role_id == 3 && $user->id != $id) {
//             return redirect()->route('home')->with('error', '他のユーザーのページにはアクセスできません。');
//         }

//         // role_idが1（admin）の場合は全てのユーザーにアクセス可能
//         if ($user->role_id == 1) {
//             return $next($request);
//         }

//         // それ以外はアクセス拒否
//         return redirect()->route('home')->with('error', 'アクセス権限がありません。');

//     }
// }
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

//　これは機能した
//     public function handle(Request $request, Closure $next): Response
// {
//     $user = Auth::user();
//     $id = $request->route('id');
// // dd(gettype($id));

//     if ( $user->id != $id) {
        
//         return redirect()->back(); 

//     }


    
//         return $next($request);

// }

public function handle(Request $request, Closure $next): Response
{
    $user = Auth::user();
    $id = $request->route('id');

    // role_idが1のadminユーザーの場合はすべてのページにアクセス可能
    if ($user->role_id == 1) {
        return $next($request);
    }

    // 一般ユーザーの場合、自分のid以外のアクセスを拒否
    if ($user->id != $id) {
        return redirect()->back()->with('error', '他のユーザーのページにはアクセスできません。');
    }

    return $next($request);
}



}

