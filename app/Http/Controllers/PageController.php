<?php

namespace App\Http\Controllers;

use App\Models\Admin\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($alias){

        // Get the Post
        $default_language = default_language();
        $static_data = static_home();
        $page = Page::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('alias', $alias)->first();

        if($page){
        	return view('home.page', compact('page', 'static_data'));
        }else{
        	abort(404);
        }
    }
}
