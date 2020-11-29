<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserSettingsController extends Controller
{
    public function index(){
        return view('admin.settings.user_settings');
    }

    // Inserting the keys
    public function insert(Request $request){

        $settings = Setting::where('type', 'user')->get();
        foreach($settings as $setting){
            $key = $setting->key;
            if($request->$key != ''){
                $setting->value = $request->$key;
                $setting->save();
            }
        }

        return redirect()->back();

    }
}
