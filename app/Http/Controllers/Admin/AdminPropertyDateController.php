<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPropertyDateController extends Controller
{
    public function index($id){
        $property = Property::findOrFail($id);
        return view('admin.property.date', compact('property'));
    }
}
