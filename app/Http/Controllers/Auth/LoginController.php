<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // I36N 翻译
//        $locale = \App::getLocale();
        $locale = 'zh';
        \App::setLocale($locale);
    }

//    public function login( Request $request )
//    {
//        $email    = $request->input('email');
//        $password = $request->input('password');
//
//        // 判断用户是否合法
//
//        // email
//        // password
//        return view( 'auth.login' );
//    }

}
