<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminActivityController extends Controller
{
    public function index(){
        $activities = Activity::orderBy('created_at','desc')->paginate(10);
        return view('admin.owner.activity', compact('activities'));
    }
}
