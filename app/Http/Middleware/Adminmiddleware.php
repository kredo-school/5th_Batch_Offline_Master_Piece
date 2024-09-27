<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        # Checks if the user is authenticated and has admin role.
        if(Auth::check() && Auth::user()->role_id == User::ADMIN_ROLE_ID) {
            return $next($request); # Proceeds with the request.
       }
       return redirect()->route('index'); 
       # Redirects unauthorized users to index route.
    }
}
