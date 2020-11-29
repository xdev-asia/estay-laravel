<?php

namespace App\Http\Controllers;

use App\Models\Admin\Booking;
use App\Models\Admin\UserRequest;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $static_data, $default_language, $activationFactory;
    public function __construct(){
        $this->static_data = static_home();
        $this->default_language = default_language();
    }

    public function index(){
        $static_data = $this->static_data;
        $default_language = $this->default_language;
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        if($static_data['user']){
            $request = (UserRequest::where('user_id', $static_data['user']->id)->first()) ? false : true;
            $bookings = Booking::where('user_id', $static_data['user']->id)->get();
        }else{
            $request = null;
            $bookings = null;
        }  
        return view('home.account.my_account', compact('static_data', 'default_language', 'request', 'bookings', 'currency'));
    }

    public function login(){
        $static_data = $this->static_data;
        $default_language = $this->default_language;

        return view('home.account.login', compact('static_data', 'default_language'));
    }

    public function register(){
        $static_data = $this->static_data;
        $default_language = $this->default_language;

        return view('home.account.register', compact('static_data', 'default_language'));
    }

    public function update(Request $request){
        $static_data = $this->static_data;
        $this->validate($request, [
            'username'  => 'required|unique:users,id,'.$request->id,
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users,email,'.$request->email,
            'phone' => 'phone_number',
            'password' => 'min:6|confirmed',
        ],[
            'username.required'     => $static_data['strings']['required_field'],
            'phone.phone_number'    => $static_data['strings']['phone_number_validation'],
            'username.unique'       => $static_data['strings']['not_unique_field'],
            'first_name.max'        => $static_data['strings']['max_20'],
            'last_name.max'         => $static_data['strings']['max_20'],
            'email.email'           => $static_data['strings']['email_invalid'],
            'first_name.required'   => $static_data['strings']['required_field'],
            'last_name.required'    => $static_data['strings']['required_field'],
            'password.min'          => $static_data['strings']['min_6'],
            'email.required'        => $static_data['strings']['required_field'],
            'email.unique'          => $static_data['strings']['not_unique_field'],
        ]);

        $user = User::findOrFail($request->id);

        // User info
        $user_info = UserInfo::where('user_id', $user->id);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone'     => $request->phone,
        ];
        $data['username'] = $request->username;        
        $user_info->update($data);
        unset($data);

        // Update user
        if(isset($request->password)) $data['password'] = bcrypt($request->password);
        $data['email'] = $request->email;
        $user->touch();
        $user->update($data);

        Session::flash('account_updated', true);
        return redirect('/my-account');
    }

    public function request(Request $request){
        if($request->ajax()){
            UserRequest::create([
                'user_id' => $request->id,
                'request' => 1,
                'completed' => 0,
            ]);
            return response()->json(['success' => true], 200);
        }else{
            return response()->json(['success' => false], 400);
        }
    }

    public function resend(){
        $static_data = $this->static_data;
        $default_language = $this->default_language;

        return view('home.account.resend_activation', compact('static_data', 'default_language'));
    }

    public function resetPassword(){
        $static_data = $this->static_data;
        $default_language = $this->default_language;

        return view('home.account.reset_password', compact('static_data', 'default_language'));
    }

    public function activateAccount(){
        $static_data = $this->static_data;
        return view('home.account.activate_error', compact('static_data'));
    }

    public function changeLanguage(Request $request){
        if($request->ajax()) {
            Session::set('language', $request->code);
            return response()->json(['success' => true], 200);
        }else{
            return response()->json(['success' => false], 400);
        }
    }

    public function changeCurrency(Request $request){
        if($request->ajax()) {
            // currency()->setUserCurrency($request->code);
            Session::set('currency', $request->code);
            return response()->json(['success' => true], 200);
        }else{
            return response()->json(['success' => false], 400);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
