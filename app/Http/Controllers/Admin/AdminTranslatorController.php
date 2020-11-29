<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Str;
use App\Models\Admin\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTranslatorController extends Controller
{
    public function index(){
        $strings = Str::where('default', 1)->get();
        $languages = Language::all();
        return view('admin.settings.translator', compact('strings', 'languages'));
    }

    public function getString(Request $request, $key){
        if($request->ajax()){
            $data = Str::where('key', $key)->get();
            return response()->json($data, 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function updateString(Request $request){
        if($request->ajax()){
            $data = $request->data;
            if(isset($data['en']) && $data['en'] == ''){
                return response()->json(get_string('something_happened'), 400);
            }else{
                foreach($data as $key => $value){
                    $string = Str::where([['key', $request->key], ['code', $key]])->first();
                    if($string){
                        $string->string = $value;
                        $string->save();
                    }else if($value != ''){
                        $tmp['key'] = $request->key;
                        $tmp['string'] = $value;
                        $tmp['code'] = $key;
                        Str::create($tmp);
                    }
                }
                return response()->json(get_string('successfully_updated'), 200);
            }
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function createString(Request $request){
        $this->validate($request, [
            'key' => 'required',
            'string.en' => 'required'
        ],[
            'key.required' => get_string('string_key_required'),
            'string.en.required' => get_string('please_check_default_language'),
        ]);

        $data['key'] = $request->key;
        foreach($request->string as $key => $value){
            if($value != ''){
                $data['code'] = $key; 
                $data['string'] = substr($value, 0, 200);
                $data['default'] = ($key == 'en') ? 1 : 0;
                Str::create($data);
            }
        }

        return redirect()->back();
    }
}
