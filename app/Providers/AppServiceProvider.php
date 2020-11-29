<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Language;
use App\Models\Admin\UserRequest;

use Illuminate\Support\ServiceProvider;
use Visitor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom Validators
        Validator::extend('business_hours', 'App\Http\CustomValidator@businessHours');
        Validator::extend('phone_number', 'App\Http\CustomValidator@phoneNumber');
        Validator::extend('website', 'App\Http\CustomValidator@website');
        if(env('INSTALLED', false)){ Visitor::log();}
        
        View::composer('errors/404', function($view)
        {
            $view->with([
                'static_data' => static_home(),
                'default_language' => default_language(),
            ]);
        });

        View::composer('home/home', function($view)
        {
            $custom_css = View::make('home.styles.custom')->render();
            $currencies = currency()->getCurrencies();
            if(Auth::check()){
                $request = (UserRequest::where('user_id', Auth::user()->id)->first()) ? false : true;       
            }else{
                $request = false;   
            }
            $request = get_setting('allow_add_property_button', 'design') ? $request : false;
            $request = get_setting('allow_user_requests', 'owner') ? $request : false;
            $view->with([
                'custom_css' => $custom_css,
                'currencies' => $currencies,
                'owner_request' => $request,
            ]);
        });
        View::composer('layouts/home_layout', function($view)
        {
            $custom_css = View::make('home.styles.custom')->render();
            $currencies = currency()->getCurrencies();
            if(Auth::check()){
                $request = (UserRequest::where('user_id', Auth::user()->id)->first()) ? false : true;       
            }else{
                $request = false;   
            }
            $request = get_setting('allow_add_property_button', 'design') ? $request : false;
            $request = get_setting('allow_user_requests', 'owner') ? $request : false;
            $view->with([
                'custom_css' => $custom_css,
                'currencies' => $currencies,
                'owner_request' => $request,
            ]);
        });
        View::composer('layouts/home_explore', function($view)
        {
            $custom_css = View::make('home.styles.custom')->render();
            $currencies = currency()->getCurrencies();
            if(Auth::check()){
                $request = (UserRequest::where('user_id', Auth::user()->id)->first()) ? false : true;       
            }else{
                $request = false;   
            }
            $request = get_setting('allow_add_property_button', 'design') ? $request : false;
            $request = get_setting('allow_user_requests', 'owner') ? $request : false;
            $view->with([
                'custom_css' => $custom_css,
                'currencies' => $currencies,
                'owner_request' => $request,
            ]);
        });
        View::composer('owner/dashboard', function($view)
        {
            $entrance_fee = get_setting('entrance_fee', 'payment');
            $currency = get_setting('currency_code', 'site');
            $points = get_string('points');
            $packages = [];
            if($entrance_fee < 10) $packages[1] = '10 '.$points.' - ' .get_setting('package_10', 'payment') .' '.$currency;
            if($entrance_fee < 30) $packages[2] = '30 '.$points.' - ' .get_setting('package_30', 'payment') .' '.$currency;
            if($entrance_fee < 50) $packages[3] = '50 '.$points.' - ' .get_setting('package_50', 'payment') .' '.$currency;
            if($entrance_fee < 100) $packages[4] = '100 '.$points.' - ' .get_setting('package_100', 'payment') .' '.$currency;
            if($entrance_fee < 200) $packages[5] = '200 '.$points.' - ' .get_setting('package_200', 'payment') .' '.$currency;
            $gateways = [];
            if(get_setting('allow_paypal', 'payment')){
                $gateways[] = 'PayPal';
            }
            if(get_setting('allow_stripe', 'payment')){
                $gateways[] = 'Stripe';
            }
            if(!count($gateways)){
                $gateways[] = 'None';
            }
            $view->with([
                'gateways' => $gateways,
                'packages' => $packages,
            ]);
        });

        if(env('INSTALLED', false) && !Session::has('language')){
            $language = Language::where('default', 1)->first();
            if($language){
                Session::put('language', $language->code);
            }else{
                $language = Language::findOrFail(1);
                if($language){
                    Session::put('language', $language->code);
                }else{
                    Session::put('language', 'en');
                }
            }
        }
        return;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
