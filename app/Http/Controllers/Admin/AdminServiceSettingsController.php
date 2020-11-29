<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminServiceSettingsController extends Controller
{
    public function index(){
        return view('admin.settings.service_settings');
    }

    // Inserting the keys
    public function insert(Request $request){

        $settings = Setting::where('type', 'service')->get();
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
