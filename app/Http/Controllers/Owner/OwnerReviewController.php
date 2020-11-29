<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Property;
use App\Models\Admin\Review;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OwnerReviewController extends Controller
{
    protected $user;
    public function __construct(){
        $this->user = Auth::user();
    }

    public function index(){
        $user = $this->user;
        $prop_ids = Property::where('user_id', $user->id)->get()->pluck('id');
        $serv_ids = Service::where('user_id', $user->id)->get()->pluck('id');
        $reviews = Review::whereIn('property_id', $prop_ids)->orWhereIn('service_id', $serv_ids)->paginate(10);
        return view('owner.review', compact('reviews'));
    }

    // Get Review
    public function getReview(Request $request, $id){
        if($request->ajax()) {
            $review = Review::findOrFail($id);
            return response()->json($review->review, 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

}
