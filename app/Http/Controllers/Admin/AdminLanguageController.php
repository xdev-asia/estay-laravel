<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Language;
use App\Models\Admin\Str;
use App\Models\Admin\PropertyContent;
use App\Models\Admin\ServiceContent;
use App\Models\Admin\LocationContent;
use App\Models\Admin\PageContent;
use App\Models\Admin\BlogContent;
use App\Models\Admin\FaqContent;
use App\Models\Admin\Feature;
use App\Models\Admin\CategoryContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AdminLanguageController extends Controller
{
    public function index(){
        $languages = Language::paginate(10);
        return view('admin.settings.language', compact('languages'));
    }
    
    public function destroy(Request $request, $id){
        if($request->ajax()) {
            if($id == 1){
                return response()->json(get_string('cannot_delete_default_language'), 400);
            }else{
                $language = Language::findOrFail($id);
                // Strings
                $strings = Str::where('code', $language->code)->get();
                foreach($strings as $string){
                    $string->delete();
                }

                // Property Content
                $p_content = PropertyContent::where('language_id', $id)->get();
                foreach($p_content as $content){
                    $content->delete();
                }

                // Service Content
                $s_content = ServiceContent::where('language_id', $id)->get();
                foreach($s_content as $content){
                    $content->delete();
                }

                // Location Content
                $l_content = LocationContent::where('language_id', $id)->get();
                foreach($l_content as $content){
                    $content->delete();
                }

                // Category Content
                $c_content = CategoryContent::where('language_id', $id)->get();
                foreach($c_content as $content){
                    $content->delete();
                }

                // Page Content
                $pg_content = PageContent::where('language_id', $id)->get();
                foreach($pg_content as $content){
                    $content->delete();
                }

                // FAQ Content
                $faq_content = FaqContent::where('language_id', $id)->get();
                foreach($faq_content as $content){
                    $content->delete();
                }

                // Blog Content
                $b_content = BlogContent::where('language_id', $id)->get();
                foreach($b_content as $content){
                    $content->delete();
                }

                // Blog Content
                $features = Feature::all();
                foreach($features as $feature){
                    if($feature->feature){
                        $tmp = $feature->feature;
                        unset($tmp[$language->id]);
                        $feature->feature = $tmp;
                        $feature->save();
                    }
                }

                // Features
                $features = Feature::all();
                foreach($features as $feature){
                    $tmp = $feature->feature;
                    unset($tmp[$language->id]);
                    $feature->update(['feature' => $tmp]);
                }

                // Delete the language
                $language->delete();
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Making Default Language
    public function makeDefault(Request $request, $id){

        if($request->ajax()) {
            $language = Language::where('default', 1)->first();
            $language->default = 0;
            $language->save();

            $new_language = Language::findOrFail($id);
            $new_language->default = 1;
            $new_language->save();
            return response()->json(get_string('success_make_default'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Updating Language
    public function update(Request $request){
        $code = (strlen($request->code) > 2) ? substr($request->code, 0, 2) : $request->code;
        $flag = (strlen($request->flag) > 6) ? substr($request->flag, 0, 6) : $request->flag;
        // Update
        if($request->id){
            // Get the language for editing
            $language = Language::findOrFail($request->id);
            if($code != $language->code){
                Str::where('code', $language->code)->update(['code' => $code]);
            }
            // Update the language
            $data = $request->all();
            $data['code'] = $code;
            $data['flag'] = $flag;
            $language->update($data);

        }
        // Create
        else{
            if(!Language::where('code', $code)->first()){
                $data = $request->all();
                $data['code'] = $code;
                $data['flag'] = $flag;
                $language = Language::create($data);
                unset($data);
                $default_language = Language::where('default', 1)->first();
                
                // Strings
                $strings = Str::where('default', 1)->get();
                $tmp = []; $i = 0;
                foreach($strings as $string){
                    $tmp[$i] = $string->toArray();
                    $tmp[$i]['code'] = $code;
                    $tmp[$i]['default'] = 0;
                    unset($tmp[$i]['id']);
                    $i++;
                }
                if(count($tmp)){
                    Str::insert($tmp);
                }

                // Property Content
                $tmp = []; $i = 0;
                $p_content = PropertyContent::where('language_id', $default_language->id)->get();
                foreach($p_content as $content){
                    $tmp[$i] = $content->toArray();
                    $tmp[$i]['language_id'] = $language->id;
                    unset($tmp[$i]['id']);
                    $i++;
                } 
                if(count($tmp)){
                    PropertyContent::insert($tmp);
                }

                // Service Content
                $tmp = []; $i = 0;
                $s_content = ServiceContent::where('language_id', $default_language->id)->get();
                foreach($s_content as $content){
                    $tmp[$i] = $content->toArray();
                    $tmp[$i]['language_id'] = $language->id;
                    unset($tmp[$i]['id']);
                    $i++;
                } 
                if(count($tmp)){
                    ServiceContent::insert($tmp);
                }

                // FAQ Content
                $tmp = []; $i = 0;
                $faq_content = FaqContent::where('language_id', $default_language->id)->get();
                foreach($faq_content as $content){
                    $tmp[$i] = $content->toArray();
                    $tmp[$i]['language_id'] = $language->id;
                    unset($tmp[$i]['id']);
                    $i++;
                } 
                if(count($tmp)){
                    FaqContent::insert($tmp);
                }

                // Location Content
                $l_content = LocationContent::where('language_id', $default_language->id)->get();
                $tmp = []; $i = 0;
                foreach($l_content as $content){
                    $tmp[$i] = $content->toArray();
                    $tmp[$i]['language_id'] = $language->id;
                    unset($tmp[$i]['id']);
                    $i++;
                } 
                if(count($tmp)){
                    LocationContent::insert($tmp);
                }

                // Category Content
                $c_content = CategoryContent::where('language_id', $default_language->id)->get();
                $tmp = []; $i = 0;
                foreach($c_content as $content){
                    $tmp[$i] = $content->toArray();
                    $tmp[$i]['language_id'] = $language->id;
                    unset($tmp[$i]['id']);
                    $i++;
                }  
                if(count($tmp)){
                    CategoryContent::insert($tmp);
                }

                // Page Content
                $pg_content = PageContent::where('language_id', $default_language->id)->get();
                $tmp = []; $i = 0;
                foreach($pg_content as $content){
                    $tmp[$i] = $content->toArray();
                    $tmp[$i]['language_id'] = $language->id;
                    unset($tmp[$i]['id']);
                    $i++;
                }  
                if(count($tmp)){
                    PageContent::insert($tmp);
                } 

                // Blog Content
                $b_content = BlogContent::where('language_id', $default_language->id)->get();
                $tmp = []; $i = 0;
                foreach($b_content as $content){
                    $tmp[$i] = $content->toArray();
                    $tmp[$i]['language_id'] = $language->id;
                    unset($tmp[$i]['id']);
                    $i++;
                } 
                if(count($tmp)){
                    BlogContent::insert($tmp);
                }

                // Features
                $features = Feature::all();
                foreach($features as $feature){
                    $tmp = $feature->feature;
                    $tmp[$language->id] = '';
                    $feature->update(['feature' => $tmp]);
                } 
            }else{
                return redirect()->back();
            }

        }
        // Refresh the page
        return redirect()->back();
    }

    public function export(){
        $languages = Language::all()->pluck('code', 'id')->toArray();
        if($languages){
            $data[0] = array_merge(['0' => 'key', '1' => 'is_backend'], $languages);
            $keys = Str::select('key', 'is_backend')->where('default', 1)->get()->toArray();
            foreach($languages as $key => $value){
                $tmp[$value] = Str::where('code', $value)->get()->pluck('string', 'key')->toArray();
            }
            foreach($keys as $str_key){
                $tmp_data = [$str_key['key']];
                $is_backend = ($str_key['is_backend']) ? 1 : 0;
                array_push($tmp_data, $is_backend);
                foreach($languages as $key => $value){
                    if(isset($tmp[$value][$str_key['key']])){
                        array_push($tmp_data, $tmp[$value][$str_key['key']]);
                    }else{
                        array_push($tmp_data, '');
                    }
                }
                $data[] = $tmp_data;
            }
            Excel::create('Strings', function($excel) use ($data){
                $site_name = get_setting('site_name', 'site');
                // Set the title
                $excel->setTitle('Strings - ' . $site_name);
                $excel->setCreator($site_name)->setCompany($site_name);
                $excel->setDescription('Easy import/export strings!');
                $excel->sheet('Strings', function($sheet) use ($data){
                    // $sheet->row(1, $head);
                    $sheet->fromArray($data, null, 'A1', true, false);
                });

            })->export('xls');
        }
    }

    public function import(Request $request){
        if($request->ajax()){
            $file = $request->file('file');
            if(isset($file) && $file->isValid()){
                $path = $file->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                $languages = Language::all();
                if(!empty($data) && $data->count()){
                    foreach ($data as $item) {
                        foreach($languages as $language){
                            $string = Str::firstOrNew(['code' => $language->code, 'key' => $item['key']]);
                            $string->string = ($item[$language->code]) ? $item[$language->code] : '';
                            $string->is_backend = $item['is_backend'];
                            $string->save();
                        }
                    }
                    return response()->json(get_string('successfully_imported'), 200);
                }else{
                    return response()->json(get_string('something_happened'), 400);

                }
            }else{
                return response()->json(get_string('something_happened'), 400);

            }
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

}
