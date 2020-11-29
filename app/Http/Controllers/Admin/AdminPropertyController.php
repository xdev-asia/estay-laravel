<?php

namespace App\Http\Controllers\Admin;

use App\Common\Utility;
use App\Models\Admin\Language;
use App\Models\Admin\LocationContent;
use App\Models\Admin\Property;
use App\Models\Admin\CategoryContent;
use App\Models\Admin\PropertyContent;
use App\Models\Admin\PropertyDate;
use App\Models\Admin\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;

class AdminPropertyController extends Controller
{
    private $validation_rules, $validation_messages;
    protected $languages;
    public function __construct(){
        $this->validation_rules = [
            'business_hours.sat'      => 'business_hours',
            'business_hours.week'     => 'business_hours',
            'business_hours.sun'      => 'business_hours',
            'category_id'             => 'required',
            // 'type_id'              => 'required',
            'location_id'             => 'required',
            'location.address'        => 'required',
            'location.city'           => 'required',
            'location.country'        => 'required',
            'location.geo_lon'        => 'required',
            'location.geo_lat'        => 'required',
            'contact.tel1'            => 'phone_number',
            'contact.tel2'            => 'phone_number',
            'contact.fax'             => 'phone_number',
            'contact.email'           => 'email',
            'contact.web'             => 'website',
            'rooms'                   => 'required|integer',
            'guest_number'            => 'required|integer',
            'price_per_night'         => 'required|integer',
            'property_info.size'      => 'integer',
            'property_info.bedrooms'  => 'integer',
            'property_info.bathrooms' => 'integer',
            'prices.d_5'              => 'integer|required',
            'prices.d_15'             => 'integer|required',
            'prices.d_30'             => 'integer|required',
            'fees.city_fee'           => 'integer',
            'fees.cleaning_fee'       => 'integer',
        ];

        $this->validation_messages = [
            'business_hours.sat.business_hours'  => get_string('business_hours_validation'),
            'business_hours.week.business_hours' => get_string('business_hours_validation'),
            'business_hours.sun.business_hours'  => get_string('business_hours_validation'),
            'contact.tel1.phone_number'          => get_string('phone_number_validation'),
            'contact.tel2.phone_number'          => get_string('phone_number_validation'),
            'contact.fax.phone_number'           => get_string('phone_number_validation'),
            'contact.web.website'                => get_string('website_validation'),
            'location.address.required'          => get_string('address_required'),
            'location.city.required'             => get_string('city_required'),
            'location.country.required'          => get_string('country_required'),
            'location.geo_lon.required'          => get_string('google_address_required'),
            'location.geo_lat.required'          => get_string('google_address_required'),
            'contact.email.email'                => get_string('email_invalid'),
            'category_id.required'               => get_string('category_required'),
            'rooms.required'                     => get_string('required_field'),
            'prices.d_15'                        => get_string('required_field'),
            'prices.d_5'                         => get_string('required_field'),
            'prices.d_30'                        => get_string('required_field'),
            'price_per_night.required'           => get_string('required_field'),
            'guest_number.required'              => get_string('required_field'),
            // 'type_id.required'                => get_string('type_required'),
            'location_id.required'               => get_string('location_required'),
        ];
        $this->languages = Language::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('created_at','desc')->paginate(10);
        return view('admin.property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $default_language = Language::where('default', 1)->first();
        $categories = CategoryContent::where('language_id', $default_language->id)->get()->pluck('name', 'category_id');
        $locations = LocationContent::where('language_id', $default_language->id)->get()->pluck('location', 'location_id');
        $languages = $this->languages;
        $features = Feature::all();
        return view('admin.property.create', compact('categories', 'languages', 'features', 'default_language', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $languages = $this->languages;
        // Validating the Property
        if($this->validateService($request)){
            return $this->validateService($request);
        }

        // Store to base
        $data = $request->except('markers', '_token', 'action', 'images', 'name', 'description');
        $data['status'] = 1;
        $data['featured'] = isset($request->featured) ? 1 : 0;
        $default_language = Language::where('default', 1)->first();
        $data['alias'] = Utility::alias($request->name[$default_language->id], [], 'property');
        $property = Property::create($data);

        if(isset($request->images)){
            foreach($request->images as $image){
                Image::create(['image' => $image, 'imageable_id' => $property->id, 'imageable_type' => 'App\Models\Admin\Property']);
            }
        }

        // Updating the Content
        foreach($languages as $language) {

            unset($data);
            // Getting name
            $data['name'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['property_id'] = $property->id;
            $data['language_id']  = $language->id;

            // Create the Property Content
            PropertyContent::create($data);
        }

        // Create available dates
        PropertyDate::create(['dates' => null, 'property_id' => $property->id]);

        // Redirect after saving
        return redirect('admin/property');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Why do we need to show this? You will see it in the front-end.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $default_language = Language::where('default', 1)->first();
        $categories = CategoryContent::where('language_id', $default_language->id)->get()->pluck('name', 'category_id');
        $languages = $this->languages;
        $locations = LocationContent::where('language_id', $default_language->id)->get()->pluck('location', 'location_id');
        $features = Feature::all();
        $property = Property::findOrFail($id);
        return view('admin.property.edit', compact('property', 'categories', 'default_language', 'languages', 'features', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $languages = $this->languages;
        // Validating the Property
        if($this->validateServiceUpdate($request, $id)){
            return $this->validateServiceUpdate($request, $id);
        }

        $data = $request->except('markers', '_token', 'action', 'images', 'name', 'description');

        $property = Property::findOrFail($id);
        $property->touch();
        $default_language = Language::where('default', 1)->first();
        $data['featured'] = isset($request->featured) ? 1 : 0;

        // Update Alias
        if($request->alias){
            if($request->alias == ''){
                $data['alias'] = $property->alias;
            }else{
                $alias = Utility::fixAlias($request->alias);
                $c = count(Property::where('alias', 'LIKE', '%'. $alias .'%')->where('id', '<>', $property->id)->get());
                if($c){
                    $data['alias'] = $alias .'-'. $c;
                }else{
                    $data['alias'] = $alias;
                }
            }
        }

        $property->update($data);
        $old_images = $property->images;

        if(isset($request->images)){
            foreach($old_images as $image){
                if(!in_array_r($image->image, $request->images)){
                    $image->delete();
                }
            }
            $old_images = $old_images->toArray();
            foreach($request->images as $image){
                if(!in_array_r($image, $old_images)){
                    Image::create(['image' => $image, 'imageable_id' => $property->id, 'imageable_type' => 'App\Models\Admin\Property']);
                }
            }
        }

        // Updating the Content
        foreach($languages as $language) {

            unset($data);
            // Getting name
            $data['name'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['property_id'] = $property->id;
            $data['language_id']  = $language->id;

            // Update the Category Content
            $category_content = PropertyContent::where(['language_id' => $language->id, 'property_id' => $id])->first();
            $category_content->update($data);
        }

        // Redirect after saving
        return redirect('admin/property');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            $this->delete($id);
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }


    // Handling mass deletion
    public function massDestroy(Request $request){
        if($request->ajax() && isset($request->id)){
            $ids = $request->id;
            foreach ($ids as $id){
                $this->delete($id);
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Activating post
    public function activate(Request $request, $id){

        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->status = 1;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_activate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Making Featured
    public function makeFeatured(Request $request, $id){

        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->featured = 1;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_service_featured'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Make Default
    public function makeDefault(Request $request, $id){

        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->featured = 0;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_service_default'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Deactivating post
    public function deactivate(Request $request, $id){

        if($request->ajax()) {
            $property = Property::findOrFail($id);
            $property->status = 0;
            $property->touch();
            $property->save();
            return response()->json(get_string('success_deactivate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Validating the Property upon creating
    public function validateService(Request $request){

        $languages = $this->languages;
        $validator = Validator::make($request->all(), $this->validation_rules, $this->validation_messages);

        if($validator->fails()){
            if(isset($request->images)){
                foreach($request->images as $image){
                    $path = public_path('images/data/'.$image);
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            }
            return Redirect::back()->withInput()->withErrors($validator);
        }else{
            foreach($languages as $language) {
                $validator = Validator::make($request->all(), [
                    'name.' . $language->id . '' => 'required|max:50',
                    'description.' . $language->id . '' => 'required|min:100|max:5000',
                ], [
                    'name.'.$language->id.'.required'           => get_string('required_field'),
                    'name.'.$language->id.'.max'         => get_string('max_100'),
                    'description.'.$language->id.'.required'    => get_string('required_field'),
                    'description.'.$language->id.'.min'         => get_string('min_100'),
                ]);
                if($validator->fails()) {
                    if (isset($request->images)) {
                        foreach ($request->images as $image) {
                            $path = public_path('images/data/' . $image);
                            if (File::exists($path)) {
                                File::delete($path);
                            }
                        }
                    }
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            }
        }
    }

    // Validating the Property upon updating
    public function validateServiceUpdate(Request $request, $id){
        $languages = $this->languages;
        $validator = Validator::make($request->all(), $this->validation_rules, $this->validation_messages);
        $images = Property::findOrFail($id)->images->toArray();

        if($validator->fails()){
            if(isset($request->images)){
                foreach($request->images as $image){
                    if(!in_array_r($image, $images)){
                        $path = public_path('images/data/'.$image);
                        if(File::exists($path)){
                            File::delete($path);
                        }
                    }
                }
            }
            return Redirect::back()->withInput()->withErrors($validator);
        }else{
            foreach($languages as $language) {
                $validator = Validator::make($request->all(), [
                    'name.' . $language->id . '' => 'required|max:50',
                    'description.' . $language->id . '' => 'required|min:100|max:5000',
                ], [
                    'name.'.$language->id.'.required'           => get_string('required_field'),
                    'name.'.$language->id.'.max'         => get_string('max_100'),
                    'description.'.$language->id.'.required'    => get_string('required_field'),
                    'description.'.$language->id.'.min'         => get_string('min_100'),
                ]);
                if($validator->fails()) {
                    if (isset($request->images)) {
                        foreach ($request->images as $image) {
                            $path = public_path('images/data/' . $image);
                            if (File::exists($path)) {
                                File::delete($path);
                            }
                        }
                    }
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            }
        }
    }

    // Autocomplete
    public function autocomplete(Request $request){

        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];
            $default = Language::where('default', 1)->first();

            $properties = PropertyContent::where([['name', 'LIKE', '%' . $term . '%'],['language_id', '=', $default->id]])->take(5)->get();
            foreach ($properties as $property) {
                $results[] = ['id' => $property->id, 'name' => $property->name];
            }
            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching for Properties
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';

        $property_ids = PropertyContent::where('name', 'LIKE', '%'.$term.'%')->get()->pluck('property_id');

        $properties = Property::whereIn('id', $property_ids)->orderBy('created_at','desc')->paginate(10);

        return view('admin.property.search', compact('properties'));
    }

    // Helper function for delete
    public function delete($id){

        // Getting the post
        $property = Property::findOrFail($id);

        // Unlinking the images
        if($property->images){
            foreach($property->images as $image){
                $path = public_path('images/data/'.$image->image);
                if(File::exists($path) && $image->image != '/images/no_image.jpg'){
                    File::delete($path);
                }
                $image->delete();
            }
        }

        // Deleting the Content
        $languages = $this->languages;
        foreach($languages as $language){
            $property->content($language->id)->delete();
        }

        $property->prop_dates()->delete();

        // Deleting the post
        $property->delete();
    }

    public function updateDates(Request $request){
        // Update available days
        $property_dates = PropertyDate::where('property_id', $request->property_id)->first();
        $data['dates'] = explode(',', $request->dates);
        $data['dates'] = array_map('trim', $data['dates']);
        $property_dates->update($data);
        return redirect('admin/property');
    }
}
