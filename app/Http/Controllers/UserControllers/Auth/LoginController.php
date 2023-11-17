<?php

namespace App\Http\Controllers\UserControllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Google2FA;



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
    protected $redirectTo = '/account';

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        return $request->validate([
            'account_number' => 'required|numeric',
            'password' => 'required|string',
        ]);
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'account_number';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /*
    *  Get username property
    *
    *   @return string
    */
    public function username()
    {
        return $this->username;
    }
    /**
     * Signing out of session
     * @param  Request $request
     * @return url         redirect url
     */
    public function logout(Request $request)
    {
        Google2FA::logout();
        Auth::logout();
        return redirect('/account/login');
    }

}
