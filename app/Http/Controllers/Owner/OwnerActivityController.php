<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OwnerActivityController extends Controller
{
    public function index(){
        $activities = Activity::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate(10);
        return view('owner.activity', compact('activities'));
    }
}
