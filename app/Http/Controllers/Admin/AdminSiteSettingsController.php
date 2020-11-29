<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Facades\Artisan;

class AdminSiteSettingsController extends Controller
{
    public function index(){
        $timezonelist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        return view('admin.settings.site_settings', compact('timezonelist'));
    }

    // Inserting the keys
    public function insert(Request $request){

        if($request->logo){
            $file = $request->file('logo');
            if(isset($file) && $file->isValid()){
                $setting = Setting::where([['type', 'site'],['key', 'site_logo']])->first();
                $name = 'logo.' . $file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $img->save(public_path().'/assets/images/home/'. $name);
                $setting->value = $name;
                $setting->save();
            }
        }

        if($request->favicon){
            $file = $request->file('favicon');
            if(isset($file) && $file->isValid()){
                $name = 'favicon.ico';
                File::move($file->getRealPath(), public_path() . '/' . $name);
            }
        }

        $settings = Setting::where('type', 'site')->get();
        foreach($settings as $setting){
            $key = $setting->key;
            if(($request->$key != '') || ($request->$key == '' && strpos($key, 'social_') !== false)){
                $setting->value = $request->$key;
                $setting->save();
            }
        }
        return redirect()->back();

    }
}
