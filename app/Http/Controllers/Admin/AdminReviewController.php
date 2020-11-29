<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Review;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminReviewController extends Controller
{
    public function index(){
        $reviews = Review::orderBy('created_at','desc')->paginate(10);
        return view('admin.review', compact('reviews'));
    }

    // Complete Review
    public function complete(Request $request, $id){
        if($request->ajax()) {
            $review = Review::findOrFail($id);
            $review->status = 1;
            $review->touch();
            $review->save();
            return response()->json(get_string('completed_request'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Delete Review
    public function delete(Request $request, $id){
        if($request->ajax()) {
            $review = Review::findOrFail($id);
            $review->delete();
            return response()->json(get_string('delete_request_completed'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
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
