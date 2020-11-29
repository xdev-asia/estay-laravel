<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OwnerPropertyDateController extends Controller
{
    public function index($id){
        $property = Property::findOrFail($id);
        return view('owner.property.date', compact('property'));
    }
}
