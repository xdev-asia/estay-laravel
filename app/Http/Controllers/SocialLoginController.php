<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\Setting;
use App\Models\Social;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;


class SocialLoginController extends Controller
{
	protected $fb_config, $gp_config, $fb, $gp;
	public function __construct(){
		$settings = Setting::where('type', 'user')->get()->pluck('value', 'key')->toArray();		
		// Facebook Configuration
		$this->fb_config = [
			'client_id' => $settings['facebook_api_id'],
			'client_secret' => $settings['facebook_api_secret'],
			'redirect' => route('facebook_callback'),
		];

		$this->gp_config = [
			'client_id' => $settings['google_api_id'],
			'client_secret' => $settings['google_api_secret'],
			'redirect' => route('google_callback'),
		];

		$this->fb = Socialite::buildProvider(\Laravel\Socialite\Two\FacebookProvider::class, $this->fb_config);
		$this->gp = Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class, $this->gp_config);
	}
    public function facebookRedirect(){
    	$fb = $this->fb;
        return $fb->redirect();
    }   

    public function facebookCallback(){
        $fb = $this->fb;
       	$user = $this->createOrGet($fb->user(), 'facebook');

        Auth::login($user);
        return redirect()->route('home');
    }

    public function googleRedirect(){
        $gp = $this->gp;
        return $gp->redirect();
    }   

    public function googleCallback(){
        $gp = $this->gp;
        $user = $this->createOrGet($gp->user(), 'google');

        Auth::login($user);
        return redirect()->route('home');
    }

    protected function createOrGet($user, $method){

    	// Get the account if exists
        $account = Social::where('social_type', $method)->where('social_user_id', $user->getId())->first();
        if ($account) {
            return $account->user;
        }else{

        	// Create if there is no Social account
            $account = Social::create([
                'social_user_id' => $user->getId(),
                'social_type' => $method
            ]);

            // Check if there is user with the email
            $acc = User::where('email', $user->getEmail())->first();

            // Create one if doesnt exists
            if (!$acc) {
                $acc = User::create([
                	'username' => $user->getNickname() ? $user->getNickname() : 'social'.$account->id,
                    'email' => $user->getEmail(),
                    'password' => bcrypt(randomPassword()),
                    'role_id' => 3,
                    'is_active' => 1
                ]);
                UserInfo::create([
                	 'first_name' => '',
                	 'last_name' => '',
                	 'phone'	=> '',
                	 'user_id' => $acc->id
            	]);
            }

            $account->user()->associate($acc);
            $account->save();

            return $acc;

        }
    }


}
