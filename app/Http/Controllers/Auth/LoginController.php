<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Factories\ActivationFactory;
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
     * Where to redirect users after login / registration.
     *
     * @var string
    protected $redirectTo = '/home';
    */


    /*
     * Create a new controller instance.
     *
     * @return void
     */
    protected $activationFactory;
    public function __construct(ActivationFactory $activationFactory)
    {
        $this->activationFactory = $activationFactory;
        $this->middleware('guest', ['except' => 'logout']);

    }

    /*
     * Overriding the authenticated function
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->role->id == 1){
            return redirect()->route('admin_dashboard');
        }else if($user->role->id == 2){
            return redirect()->route('owner_dashboard');
        }else{
            if(!$user->is_active){
                $this->activationFactory->sendActivationMail($user);
                auth()->logout();
                return back()->with('activationWarning', true);
            }else{
                return redirect()->route('home');
            }
        }
    }

    public function resendMail(Request $request){

        $static_data = static_home();
        // Validate the request
        $this->validate($request, [
            'email' => 'required|email'
        ],[
            'email.email'           => $static_data['strings']['email_invalid'],
            'email.required'        => $static_data['strings']['required_field'],
        ]);

        // Find the user and resend activation mail
        $user = User::where('email', $request->email)->first();
        if($user){
            $this->activationFactory->resendActivationMail($user);
            return redirect('/login')->with('activationStatus', true);
        }else{
            return back()->with('notFoundEmail', true);
        }

    }
}
