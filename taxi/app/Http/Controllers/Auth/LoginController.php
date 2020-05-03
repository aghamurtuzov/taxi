<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Ut_users;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:ut_users')->except('logout');
    }

    private function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('ut_users');
    }

//    protected function credentials( Request $request )
//    {
//        return array_merge( $request -> only( $this -> username() , 'password' ) , [ 'active' => 1 , 'delete' => 0 ] );
//    }
}
