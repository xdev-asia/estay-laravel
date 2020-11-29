<?php

namespace App\Http\Controllers;

use App\Models\Admin\Location;
use App\Models\Admin\Property;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LocationController extends Controller
{
    protected $default_language, $static_data;
    public function __construct(){
        $this->default_language = default_language();
        $this->static_data = static_home();

    }

    public function index($alias){

        // Get the Category
        $default_language = $this->default_language;
        $static_data = $this->static_data;

        // Get Category, Properties and Services -- Eager Loading
        $location = Location::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('alias', $alias)->first();

        $properties = Property::with(['images', 'contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('location_id', $location->id)->where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();

        if(get_setting('allow_featured_properties','property')){
            $featured_properties = Property::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('location_id', $location->id)->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
        }else{
            $featured_properties = null;
        }
        if(get_setting('services_allowed', 'service')){
            $services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('location_id', $location->id)->where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();
            if(get_setting('allow_featured_services', 'service')){
                $featured_services = Service::with(['images', 'contentload' => function($query) use($default_language){
                    $query->where('language_id', $default_language->id);
                }])->where('location_id', $location->id)->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
            }else{
                $featured_services = null;
            }
        }else{
            $services = null;
        }

        return view('home.location', compact('static_data', 'location', 'default_language',
            'services', 'properties', 'featured_properties', 'featured_services'));
    }

    // Get Additional Properties
    public function get_properties(Request $request, $id){
        if($request->ajax()){
            $default_language = $this->default_language;
            $static_data = $this->static_data;
            $properties = Property::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('location_id', $id)->where('status', 1)->orderBy('created_at', 'desc')->paginate(3);
            return View::make('home.templates.properties', ['properties' => $properties, 'static_data' => $static_data])->render();
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Get Additional Services
    public function get_services(Request $request, $id){
        if($request->ajax()){
            $default_language = $this->default_language;
            $static_data = $this->static_data;
            $services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('location_id', $id)->where('status', 1)->orderBy('created_at', 'desc')->paginate(3);
            return View::make('home.templates.services', ['services' => $services, 'static_data' => $static_data])->render();
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

}
