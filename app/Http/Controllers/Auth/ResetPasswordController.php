<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected $subject;
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
        $this->subject = 'Reset Password - '.get_setting('site_name', 'site');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('home.account.reset')->with(
            ['token' => $token, 'email' => $request->email, 'static_data' => static_home()]
        );
    }

}
