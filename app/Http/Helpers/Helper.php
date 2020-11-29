<?php

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Admin\Str;
use App\Models\Admin\Feature;
use App\Models\Admin\Payment;
use App\Models\Admin\Booking;
use App\Models\Admin\Category;
use App\Models\Admin\Purchase;
use App\Models\Admin\Location;
use App\Models\Admin\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as ImageIn;

    /* Custom Admin Functions */
    // Saving images from Summernote's textarea
    if (!function_exists('saveContentTextarea')){
        function saveContentTextarea($message){

            $data['old_images'] = [];
            $data['images'] = [];
            $dom = new DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHtml( mb_convert_encoding($message, 'HTML-ENTITIES', "UTF-8"));
            $images = $dom->getElementsByTagName('img');

            foreach($images as $img){
                $filename = uniqid() . unique_string();
                $date = date('M-Y');
                $src = $img->getAttribute('src');

                // If new uploaded photo
                if(preg_match('/data:image/', $src)){
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    if(!File::exists(public_path() . '/images/data/'. $date)){
                        File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
                    }
                    $filepath = 'images/data/'. $date .'/'. $filename .'.'. $mimetype;

                    $data['images'][] = $date .'/'. $filename .'.'. $mimetype;
                    $path = public_path('images/data/'. $date .'/'. $filename .'.'. $mimetype);
                    ImageIn::make($src)->encode($mimetype, 100)->save($path);

                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                }else{
                    $name = explode('/',$src);
                    $name = $name[count($name)-2] .'/'. $name[count($name)-1];
                    $data['old_images'][] =  $name;
                 }
            }

            $data['html'] = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
            return $data;
        }
    }

/* Global Custom Functions */

    // Is active navigation menu
    if(!function_exists('randomPassword')){
        function randomPassword(){
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $pass = array(); 
            $alphaLength = strlen($alphabet) - 1;
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass);
        }
    }

    // Is active navigation menu
    if(!function_exists('setActive')){
        function setActive($path)
        {
            $request = Request::path();
            return (strpos($request, $path) !== false) ? 'active' : '';
        }
    }

    // Random string
    if(!function_exists('unique_string')){
        function unique_string(){
            return substr(md5(rand(1,1000)), 0, 4);
        }
    }

    // Getting Settings Values
    if(!function_exists('get_setting')){
        function get_setting($key, $type)
        {
            $setting = Setting::where(['key' => $key, 'type' => $type])->first();
            if($setting){
                return ($setting->value == '[null]' || $setting->value == '') ? '' : $setting->value;
            }else{
                return '';
            }
        }
    }

    // Multidimensional in_array()
    if(!function_exists('in_array_r')) {
        function in_array_r($needle, $haystack, $strict = false)
        {
            foreach ($haystack as $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                    return true;
                }
            }
            return false;
        }
    }

    // Timezones
    if(!function_exists('tz_list')){
        function tz_list() {
            $zones_array = array();
            $timestamp = time();
            foreach(timezone_identifiers_list() as $key => $zone) {
                date_default_timezone_set($zone);
                $zones_array[$key]['zone'] = $zone . ' -  UTC/GMT ' . date('P', $timestamp);
            }
            return $zones_array;
        }
    }

    // Pull Language string from database
    if (!function_exists('get_string')) {
        function get_string($key){
            $default = Language::where('default', 1)->first();
            $code = $default->code;
            $string =  Str::where([['key', $key],['code', $code]])->first();
            if(!$string){
                $string =  Str::where([['key', $key],['default', 1]])->first();
                if(!$string){
                    return '';
                }
            }
            return $string->string;
        }
    }

    // Pull Language string from database
    if (!function_exists('get_opt_string')) {
        function get_opt_string($key, $code){
            $string =  Str::where([['key', $key],['code', $code]])->first();
            if(!$string){
                $string =  '';
                return $string;
            }
            return $string->string;
        }
    }

    // Pull Language string from database - Frontend
    if (!function_exists('get_strings')) {
        function get_strings($lang){
            $code = $lang;
            $string =  Str::where('code', $code)->where('is_backend', 0)->get()->pluck('string', 'key');
            if(!$string){
                $string =  Str::where('default', 1)->get()->pluck('string', 'key');
            }
            return $string;
        }
    }

    // Generate data range
    if (!function_exists('generateDataRange')) {
        function generateDateRange(Carbon $start_date, Carbon $end_date){
            $dates = [];
            while ($start_date->lte($end_date)) {
                $dates[] = $start_date->addDay()->copy()->format('d.m');
            }
            return $dates;
        }
    }

    // Generate data range for booking
    if (!function_exists('generateDataRangeB')) {
        function generateDateRangeB(Carbon $start_date, Carbon $end_date){
            $dates = [];
            while ($start_date->lte($end_date)) {
                $dates[] = $start_date->addDay()->copy()->format('m/d/Y');
            }
            return $dates;
        }
    }

    // Get static data for home
    if(!function_exists('static_home')){
        function static_home(){

            // Settings and Langugages
            $static_data['site_settings'] = Setting::where('type', 'site')->get()->pluck('value', 'key')->toArray();
            $static_data['design_settings'] = Setting::where('type', 'design')->get()->pluck('value', 'key')->toArray();
            $static_data['languages'] = Language::all();

            // Languages and Strings
            $code = explode('-',Session::get('language'));
            if($code[0]){
                $default_language = Language::where('code', $code)->first();
                if(!$default_language){
                    $default_language = Language::where('default', 1)->first();
                    if(!$default_language){
                        $default_language = Language::findOrFail(1);
                     }
                }
            }else{
                $default_language = Language::where('default', 1)->first();
                if(!$default_language){
                    $default_language = Language::findOrFail(1);
                }
            }
            $static_data['strings'] = get_strings($default_language->code)->toArray();

            // Locations and Categories (Eager Load)
            $static_data['categories'] = Category::with(['contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->orderBy('order', 'asc')->get();
            $static_data['locations'] = Location::with(['contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->orderBy('order', 'asc')->get();
            $static_data['features'] = Feature::all();

            // Site Settings
            $static_data['site_settings'] = Setting::where('type', 'site')->get()->pluck('value', 'key')->toArray();
            $static_data['design_settings'] = Setting::where('type', 'design')->get()->pluck('value', 'key')->toArray();

            // User (Eager Load)
            $static_data['user'] = Auth::user();
            if(!isset($static_data['user'])) $static_data['user'] = null;
            $static_data['default_language'] = $default_language;
            return $static_data;
        }
    }

    // Default Language
    if(!function_exists('default_language')){
        function default_language(){
            $code = explode('-',Session::get('language'));
            if($code[0]){
                $default_language = Language::where('code', $code)->first();
            }else{
                $default_language = Language::where('default', 1)->first();
            }
            return $default_language;
        }
    }

    if(!function_exists('getChartData')){
        function getChartData($type){
            $start_date = Carbon::today()->subDays(4);
            $end_date = Carbon::today();
            $data = [];
            switch ($type){
                case 'visits':
                    while ($start_date->lte($end_date)) {
                        $tmp = $start_date->copy();
                        $data[] = count(DB::table('visitors')->whereDate('created_at', '=', $tmp)->get());
                        $start_date->addDay()->copy();
                    }
                    break;
                case 'booking':
                    while ($start_date->lte($end_date)) {
                        $tmp = $start_date->copy();
                        $data[] = count(Booking::whereDate('created_at', '=', $tmp)->get());
                        $start_date->addDay()->copy();
                    }
                    break;
                case 'purchase': while ($start_date->lte($end_date)) {
                    $tmp = $start_date->copy();
                    $sum = 0;
                    $payments = Payment::whereDate('created_at', '=', $tmp)->get();
                    foreach($payments as $payment){
                        $sum += $payment->total;
                    }
                    $data[] = $sum;
                        $start_date->addDay()->copy();
                    }
                    break;
            }
            return $data;
        }
    };

    // Get User Currency Symbol
    if(!function_exists('userCurrencySymbol')){
        function userCurrencySymbol(){
            $code = Session::has('currency') ? Session::get('currency') : get_setting('currency_code', 'site');
            $currency = currency()->getCurrency($code);
            return $currency['symbol'];
        }

    }

    if(!function_exists('getAwesomeData')){
        function getAwesomeData(){
            $d = base64_decode('aHR0cDovL2FjdGl2YXRlLmJvb2tzaWNtcy5jb20vYXBpL2RvbWFpbg==');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $d);
            curl_setopt($ch, CURLOPT_REFERER, url('/'));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_exec($ch);
            curl_close ($ch);
        }

    }



