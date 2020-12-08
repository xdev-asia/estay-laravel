<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SingleController extends Controller
{
    public function index(){
        $default_language = default_language();
        $static_data = static_home();

        return view('home.page.single', compact('default_language', 'static_data'));
    }
}
