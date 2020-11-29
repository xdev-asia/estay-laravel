<?php

namespace App\Http\Controllers;

use App\Models\Admin\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){

        // Get Blog Contents
        $default_language = default_language();
        $static_data = static_home();
        $posts = Blog::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('status', 1)->orderBy('created_at', 'desc')->paginate(10);

        return view('home.blog.index', compact('posts', 'static_data'));
    }

    public function post($alias){

        // Get the Post
        $default_language = default_language();
        $static_data = static_home();
        $post = Blog::with(['contentload' => function($query) use($default_language){
            $query->where('language_id', $default_language->id);
        }])->where('alias', $alias)->first();
        if($post){
            return view('home.blog.single', compact('post', 'static_data'));
        }else{
            abort(404);
        }

    }
}
