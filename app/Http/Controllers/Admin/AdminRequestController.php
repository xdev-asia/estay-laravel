<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Owner;
use App\Models\Admin\Property;
use App\Models\Admin\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRequestController extends Controller
{
    public function index(){
        $properties = Property::where('user_id', '<>', 1)->where('status', 0)->orderBy('created_at','desc')->get();
        // $owners = Owner::where('status', 0)->get();
        $services = Service::where('user_id', '<>', 1)->where('status', 0)->orderBy('created_at','desc')->get();
        $users = User::where('id', '<>', 1)->where('is_active', 0)->orderBy('created_at','desc')->get();
        return view('admin.request', compact('properties', 'services', 'users'));
    }
}
