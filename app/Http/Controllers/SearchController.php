<?php

namespace App\Http\Controllers;

use App\Models\Admin\Property;
use App\Models\Admin\PropertyContent;
use App\Models\Admin\Service;
use App\Models\Admin\ServiceContent;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $default_language, $static_data;
    public function __construct(){
        $this->default_language = default_language();
        $this->static_data = static_home();

    }

    public function index(Request $request){
        $default_language = $this->default_language;
        $static_data = $this->static_data;

        $term = $request->keyword ? $request->keyword : '';

        $property_ids = PropertyContent::where('name', 'LIKE', '%'.$term.'%')->get()->pluck('property_id');

        // If filtering by features is enabled
        $feature_ids = [];
        if(get_setting('filter_by_features', 'property')){
            if($request->features){
                foreach($request->features as $feature){        
                    $p = Property::whereNot('features', 'LIKE', '%"' . $feature . '"%')->pluck('id')->toArray();
                    array_push($feature_ids, $p);
                }   
                if(count($feature_ids)) $feature_ids = array_unique(array_reduce($feature_ids, 'array_merge', []));
            }
        }

        $properties = Property::with(['images', 'contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)->whereIn('id', $property_ids)->whereNotIn('id', $feature_ids);


        if($request->location_id) {
            $properties->where('location_id', $request->location_id);
        }
        if($request->category_id) {
            $properties->where('category_id', $request->category_id);
        }

        $properties = $properties->get();
            
        if(get_setting('services_allowed', 'service')){

            $service_ids = ServiceContent::where('name', 'LIKE', '%'.$term.'%')->get()->pluck('service_id');
        
            $services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->whereIn('id', $service_ids);

            if($request->location_id) {
                $services->where('location_id', $request->location_id);
            }
            if($request->category_id) {
                $services->where('category_id', $request->category_id);
            }

            $services = $services->get();
        } else {
            $services = [];
        }

        if(get_setting('allow_featured_properties','property')){
            $featured_properties = Property::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
        }else{
            $featured_properties = null;
        }

        if(get_setting('services_allowed', 'service') && get_setting('allow_featured_services', 'service')){
            $featured_services = Service::with(['images', 'contentload' => function($query) use($default_language){
                $query->where('language_id', $default_language->id);
            }])->where('status', 1)->where('featured', 1)->inRandomOrder()->take(6)->get();
        }else{
            $featured_services = null;
        }

        return view('home.search', compact('services', 'static_data', 'default_language', 'featured_properties', 'featured_services',
            'services', 'properties'));
    }
}
