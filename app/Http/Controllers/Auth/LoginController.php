<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    // use AuthenticatesUsers;
    use AuthTrait;

    // protected $redirectTo = RouteServiceProvider::HOME;


    ///__construct
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //loginForm
    public function loginForm($type)
    {

        return view('auth.login', compact('type'));
    }
    //login
    public function login(Request $request)
    {
        //return $request;

        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        } else {
            dd(2);
        }
    }


    ///logout
    public function logout(Request $request, $type)
    {

        Auth::guard($type)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
