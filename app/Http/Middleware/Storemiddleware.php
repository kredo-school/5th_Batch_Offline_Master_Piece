<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class StoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->role_id == User::STORE_ROLE_ID||Auth::user()->role_id == User::ADMIN_ROLE_ID) {
            return $next($request); # Proceeds with the request.
       }
       return redirect()->route('login'); 
       # Redirects unauthorized users to index route.
    
    }
}
