<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Language;
use App\Models\Admin\Str;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminDesignSettingsController extends Controller
{
    public function index(){
        $languages = Language::all();
        return view('admin.settings.design_settings', compact('languages'));
    }

    // Inserting the keys
    public function insert(Request $request){

        if($request->strings){
            foreach($request->strings as $key => $value){
                foreach($value as $kkey => $string){
                    $s = Str::where('key', $key)->where('code', $kkey)->first();
                    if($s){
                        $s->string = $string;
                        $s->save();
                    }
                }
            }
        }
        // Store Images
        if($request->files){
            foreach($request->files as $files){
                foreach($files as $key => $file){
                    if(isset($file) && $file->isValid()){
                        $setting = Setting::where([['type', 'design'],['key', $key]])->first();
                        $name = $file->getClientOriginalName();
                        $img = Image::make($file->getRealPath());
                        if(File::exists(public_path().'/assets/images/home/'. $setting->value)){
                            File::delete(public_path().'/assets/images/home/'. $setting->value);
                        }
                        $img->save(public_path().'/assets/images/home/'. $name);
                        $setting->value = $name;
                        $setting->save();
                    }
                }
            }
        }

        // Store Other settings
        $settings = Setting::where('type', 'design')->get();
        $data = $request->except('files', 'strings');
        foreach($settings as $setting){
            $key = $setting->key;
            if(isset($data[$key])){
                $setting->value = ($data[$key] != '') ? $data[$key] : '';
                $setting->save();
            }
        }

        return redirect()->back();

    }
}
