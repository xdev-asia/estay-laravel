<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserInfo;
use App\Models\Admin\Owner;
use App\Factories\ActivationFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    public $static_data;
    protected $activationFactory;

    public function __construct(ActivationFactory $activationFactory)
    {
        $this->activationFactory = $activationFactory;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $static_data = $this->static_data;
        return Validator::make($data, [
            'username'  => 'required|unique:users|max:20',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'phone_number',
            'password' => 'required|min:6|confirmed',
        ],[
            'username.required'     => $static_data['strings']['required_field'],
            'phone.phone_number'    => $static_data['strings']['phone_number_validation'],
            'username.unique'       => $static_data['strings']['not_unique_field'],
            'first_name.max'        => $static_data['strings']['max_20'],
            'last_name.max'         => $static_data['strings']['max_20'],
            'username.max'         => $static_data['strings']['max_20'],
            'email.email'           => $static_data['strings']['email_invalid'],
            'first_name.required'   => $static_data['strings']['required_field'],
            'last_name.required'    => $static_data['strings']['required_field'],
            'password.min'          => $static_data['strings']['min_6'],
            'password.confirmed'    => $static_data['strings']['password_confirmed_error'],
            'email.required'        => $static_data['strings']['required_field'],
            'email.unique'          => $static_data['strings']['not_unique_field'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $cond = (isset($data['register_owner']) && $data['register_owner']) ? 1 : 0; 
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $cond ? 2 : 3,
            'is_active' => 0,
        ]);
        $user_info['first_name'] = $data['first_name'];
        $user_info['last_name'] = $data['last_name'];
        $user_info['phone'] = isset($data['phone']) ? $data['phone'] : '';
        $user_info['user_id'] = $user->id;

        if(!$cond) {
            UserInfo::create($user_info);
        }else{
            Owner::create($user_info);
        }
        $this->activationFactory->sendActivationMail($user);
        Session::flash('activationSent', true);
        return $user;
    }

    public function activateUser($token){
        if ($user = $this->activationFactory->activateUser($token)) {
            $static_data = static_home();
            if(get_setting('send_welcome_email', 'user')){
                $mail_data = [
                    'first_name'        => $user->info->first_name,
                    'last_name'         => $user->info->last_name,
                    'username'          => $user->username,
                    'str_username'      => $static_data['strings']['username'],
                    'str_email'         => $static_data['strings']['email'],
                    'email'             => $user->email,
                    'welcome'           => $static_data['strings']['welcome'],
                    'to'                => $static_data['strings']['to'],
                    'site_name'         => $static_data['site_settings']['site_name'],
                    'have_nice_stay'    => $static_data['strings']['have_nice_stay'],
                    'admin_email'       => $static_data['site_settings']['contact_email'],
                ];
                $mail_data['mail_after_text'] = $static_data['strings']['mail_after_text'];
                $mail_data['regards'] = $static_data['strings']['regards'];
                // Create the mail and send it
                Mail::send('emails.welcome', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                    $m->from($mail_data['admin_email'], $mail_data['site_name']);
                    $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['welcome'] . ' ' . $mail_data['to'] . ' ' . $mail_data['site_name']);
                });
            }
            Session::flash('activationSuccess', true);
            return redirect('/login');
        }
        abort(404);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        $this->activationFactory->sendActivationMail($user);

        return redirect('/login')->with('activationStatus', true);
    }


    public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
            $this->activationFactory->sendActivationMail($user);
            auth()->logout();
            return back()->with('activationWarning', true);
        }
        return redirect()->intended($this->redirectPath());
    }
}
