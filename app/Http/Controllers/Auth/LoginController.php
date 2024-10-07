<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    const ADMIN_ROLE_ID = 1; #  Defines constant for admin role ID.
    const GUEST_ROLE_ID = 2; #  Defines constant for guest role ID.
    const STORE_ROLE_ID = 3; #  Defines constant for store role ID.

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/guest/home';

    protected function authenticated(Request $request, $user)
    {

        switch ($user->role_id) {
            case self::ADMIN_ROLE_ID:
                return redirect()->route('home');
            case self::GUEST_ROLE_ID: // Guest
                return redirect()->route('home');
            case self::STORE_ROLE_ID: // Store
                return redirect()->route('store.home');
            default:
                return redirect()->route('home');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // ログアウト後にログイン画面へリダイレクト
        return redirect('/login');
    }
}
