<?php

namespace App\Http\Controllers;

use App\Models\Admin\Property;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ExploreController extends Controller
{
    protected $default_language, $static_data;
    public function __construct(){
        $this->default_language = default_language();
        $this->static_data = static_home();

    }

    public function properties(){
        $default_language = $this->default_language;
        $static_data = $this->static_data;

        $properties = Property::with(['images', 'contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();

        $markers = $properties->pluck('location', 'id')->toArray();
        $properties_array = $properties->keyBy('id')->toArray();

        if(get_setting('allow_featured_properties','property')){
            $featured_properties = Property::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
            $featured_markers = $featured_properties->pluck('location', 'id')->toArray();
        }else{
            $featured_properties = null;
            $featured_markers = null;
        }

        return view('home.explore.properties', compact('static_data', 'default_language', 'properties', 'featured_properties',
        'markers', 'properties_array', 'featured_markers'));
    }

    public function services(){
        $default_language = $this->default_language;
        $static_data = $this->static_data;

        $services = Service::with(['images', 'contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();

        $markers = $services->pluck('location', 'id')->toArray();
        $services_array = $services->keyBy('id')->toArray();

        if(get_setting('allow_featured_properties','property')){
            $featured_services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
            $featured_markers = $featured_services->pluck('location', 'id')->toArray();
        }else{
            $featured_services = null;
            $featured_services = null;
        }

        return view('home.explore.services', compact('static_data', 'default_language', 'services', 'featured_services',
            'markers', 'services_array', 'featured_markers'));
    }

    // Get Additional Properties
    public function get_properties(Request $request){
        if($request->ajax()){
            $default_language = $this->default_language;
            $static_data = $this->static_data;
            $properties = Property::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->orderBy('created_at', 'desc')->paginate(2);
            $markers = $properties->pluck('location', 'id')->toArray();
            return View::make('home.templates.properties_explore', ['properties' => $properties, 'static_data' => $static_data, 'markers' => $markers])->render();
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Get Additional Services
    public function get_services(Request $request){
        if($request->ajax()){
            $default_language = $this->default_language;
            $static_data = $this->static_data;
            $services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->orderBy('created_at', 'desc')->paginate(2);
            $markers = $services->pluck('location', 'id')->toArray();
            return View::make('home.templates.services_explore', ['services' => $services, 'static_data' => $static_data, 'markers' => $markers])->render();
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
