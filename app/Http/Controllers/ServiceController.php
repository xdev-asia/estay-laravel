<?php

namespace App\Http\Controllers;

use App\Models\Admin\Feature;
use App\Models\Admin\Review;
use App\Models\Admin\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $default_language, $static_data;
    public function __construct(){
        $this->default_language = default_language();
        $this->static_data = static_home();

    }

    public function index($alias){
        $static_data = $this->static_data;
        $default_language = $this->default_language;
        $service = Service::with(['images', 'contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('alias', $alias)->first();
        $features = Feature::all();
        if($service){
            $reviews = Review::where('service_id', $service->id)->where('status', 1)->take(3)->get();
            $similar = Service::with(['images', 'contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
            }])->where('id', '!=', $service->id)->where(function($query) use ($service){
                $query->where('category_id', $service->category->id)->orWhere('location_id', $service->ser_location->id);
            })->inRandomOrder()->take(3)->get();

            $mainService = $service;

            return view('home.service', compact('mainService', 'service', 'static_data', 'features', 'default_language', 'similar', 'reviews'));
        }else{
            abort(404);
        }
        
    }
}
