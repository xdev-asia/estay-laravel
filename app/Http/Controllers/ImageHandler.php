<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Service;
use App\Models\Admin\Property;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageHandler extends Controller
{

    public function index(){
        return view('image');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

        if(null !== $request->file('file')) $file = $request->file('file');
        if ($request->ajax() && isset($file) && $file->isValid()) {
            $name = uniqid() . unique_string() .'.'. $file->getClientOriginalExtension();
            $img = Image::make($file->getRealPath());
            $date = date('M-Y');

            $path = public_path('/images/data/'. $date .'/'. $name);
            if(!File::exists(public_path() . '/images/data/'. $date)){
                File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
            }
            $img->save($path);
            $data = $date .'/'. $name;
            return response()->json(['success' => get_string('image_uploaded'), 'data' => $data], 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        if($request->ajax()){
            if(File::exists(public_path() . '/images/data/'. $request->data)){
                File::delete(public_path() . '/images/data/'. $request->data);
            }
            return response()->json(get_string('image_deleted'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function deleteBase(Request $request){
        if($request->ajax()){
            switch($request->type){
                case 'service':
                    $images = Service::findOrFail($request->id)->images;
                    foreach($images as $image){
                        if($image->image == $request->data){
                            $image->delete();
                        }
                    }
                    break;
                case 'property':
                    $images = Property::findOrFail($request->id)->images;
                    foreach($images as $image){
                        if($image->image == $request->data){
                            $image->delete();
                        }
                    }
                    break;
            }
            if(File::exists(public_path() . '/images/data/'. $request->data)){
                File::delete(public_path() . '/images/data/'. $request->data);
            }
            return response()->json(get_string('image_deleted'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
