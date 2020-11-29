<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Language;
use App\Models\Admin\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminFeatureController extends Controller
{
    protected $languages;
    public function __construct(){
        $this->languages = Language::all();
    }

    public function index(){
        $features = Feature::paginate(10);
        $languages = $this->languages;
        $default_language = Language::where('default', 1)->first();
        return view('admin.taxonomy.feature', compact('features', 'default_language', 'languages'));
    }

    public function destroy(Request $request, $id){
        if($request->ajax()) {
            $feature = Feature::findOrFail($id);
            $feature->delete();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Storing Feature
    public function store(Request $request){
        $languages = $this->languages;
        // Validating the request
        foreach($languages as $language){
            $this->validate($request, [
                'feature.'.$language->id.'' => 'required',
            ], [
                'feature.'.$language->id.'.required' => get_string('required_field')
            ]);
        }
        // Store the Feature
        Feature::create($request->all());

        // Refresh the page
        return redirect()->back();
    }

    // Updating Feature
    public function update(Request $request){

        // Validating the request
        $languages = $this->languages;
        foreach($languages as $language){
            $this->validate($request, [
                'feature.'.$language->id.'' => 'required',
            ], [
                'feature.'.$language->id.'.required' => get_string('required_field')
            ]);
        }

        $feature = Feature::findOrFail($request->id);
        $feature->feature = $request->feature;
        $feature->save();

        // Refresh the page
        return redirect()->back();
    }

    // Getting Feature
    public function getFeature(Request $request, $id){
        if($request->ajax()) {
            $feature = Feature::findOrFail($id);
            return response()->json($feature->feature, 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

}
