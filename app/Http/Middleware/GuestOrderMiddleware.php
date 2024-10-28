<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

class GuestOrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reserves = Reserve::where('guest_id', Auth::id())
                                    ->whereNull('reservation_number')
                                    ->get();
        if($reserves->isNotEmpty() && Auth::check()){
            return $next($request);
        }

        return redirect()->back();
    }
}
