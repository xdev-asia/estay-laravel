<?php

namespace App\Http\Controllers\Admin;

use App\Common\Utility;
use App\Models\Admin\CategoryContent;
use App\Models\Admin\Feature;
use App\Models\Admin\Language;
use App\Models\Admin\LocationContent;
use App\Models\Admin\Service;
use App\Models\Admin\ServiceContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;

class AdminServiceController extends Controller
{
    private $validation_rules, $validation_messages;
    protected $languages;
    public function __construct(){
        $this->validation_rules = [
            'business_hours.sat'    => 'business_hours',
            'business_hours.week'   => 'business_hours',
            'business_hours.sun'    => 'business_hours',
            'category_id'           => 'required',
            'location_id'           => '',
            'location.address'      => 'required',
            'location.city'         => 'required',
            'location.country'      => 'required',
            'location.geo_lon'      => 'required',
            'location.geo_lat'      => 'required',
            'contact.tel1'          => 'phone_number',
            'contact.tel2'          => 'phone_number',
            'contact.fax'           => 'phone_number',
            'contact.email'         => 'email',
            'contact.web'           => 'website',
        ];

        $this->validation_messages = [
            'business_hours.sat.business_hours' => get_string('business_hours_validation'),
            'business_hours.week.business_hours'=> get_string('business_hours_validation'),
            'business_hours.sun.business_hours' => get_string('business_hours_validation'),
            'contact.tel1.phone_number'         => get_string('phone_number_validation'),
            'contact.tel2.phone_number'         => get_string('phone_number_validation'),
            'contact.fax.phone_number'          => get_string('phone_number_validation'),
            'contact.web.website'               => get_string('website_validation'),
            'location.address.required'         => get_string('address_required'),
            'location.city.required'            => get_string('city_required'),
            'location.country.required'         => get_string('country_required'),
            'location.geo_lon.required'         => get_string('google_address_required'),
            'location.geo_lat.required'         => get_string('google_address_required'),
            'contact.email.email'               => get_string('email_invalid'),
            'category_id.required'              => get_string('category_required'),
            'location_id.required'              => get_string('location_required'),
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
        $services = Service::orderBy('created_at','desc')->paginate(10);
        return view('admin.service.index', compact('services'));
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
        return view('admin.service.create', compact('categories', 'languages', 'locations', 'features', 'default_language'));
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
        // Validating the Service
        if($this->validateService($request)){
            return $this->validateService($request);
        }

        // Store to base
        $data = $request->except('markers', '_token', 'action', 'images', 'name', 'description');
        $data['status'] = 1;
        $data['featured'] = isset($request->featured) ? 1 : 0;
        $default_language = Language::where('default', 1)->first();
        $data['alias'] = Utility::alias($request->name[$default_language->id], [], 'service');
        $service = Service::create($data);

        if(isset($request->images)){
            foreach($request->images as $image){
                Image::create(['image' => $image, 'imageable_id' => $service->id, 'imageable_type' => 'App\Models\Admin\Service']);
            }
        }

        // Updating the Content
        foreach($languages as $language) {

            unset($data);
            // Getting name
            $data['name'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['service_id'] = $service->id;
            $data['language_id']  = $language->id;

            // Create the Service Content
            ServiceContent::create($data);
        }

        // Redirect after saving
        return redirect('admin/service');
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
        $locations = LocationContent::where('language_id', $default_language->id)->get()->pluck('location', 'location_id');
        $languages = $this->languages;
        $features = Feature::all();
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service', 'categories', 'default_language', 'locations', 'languages', 'features'));
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
        // Validating the Service
        if($this->validateServiceUpdate($request, $id)){
            return $this->validateServiceUpdate($request, $id);
        }

        $data = $request->except('markers', '_token', 'action', 'images', 'name', 'description');

        $service = Service::findOrFail($id);
        $default_language = Language::where('default', 1)->first();
        $data['featured'] = isset($request->featured) ? 1 : 0;
        
        // Update Alias
        if($request->alias){
            if($request->alias == ''){
                $data['alias'] = $service->alias;
            }else{
                $alias = Utility::fixAlias($request->alias);
                $c = count(Service::where('alias', 'LIKE', '%'. $alias .'%')->where('id', '<>', $service->id)->get());
                if($c){
                    $data['alias'] = $alias .'-'. $c;
                }else{
                    $data['alias'] = $alias;
                }
            }
        }

        $service->touch();
        $service->update($data);
        $old_images = $service->images;

        if(isset($request->images)){
            foreach($old_images as $image){
                if(!in_array_r($image->image, $request->images)){
                    $image->delete();
                }
            }
            $old_images = $old_images->toArray();
            foreach($request->images as $image){
                if(!in_array_r($image, $old_images)){
                    Image::create(['image' => $image, 'imageable_id' => $service->id, 'imageable_type' => 'App\Models\Admin\Service']);
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
            $data['service_id'] = $service->id;
            $data['language_id']  = $language->id;

            // Update the Category Content
            $service_content = ServiceContent::where(['language_id' => $language->id, 'service_id' => $id])->first();
            $service_content->update($data);
        }

        // Redirect after saving
        return redirect('admin/service');

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
            $service = Service::findOrFail($id);
            $service->status = 1;
            $service->touch();
            $service->save();
            return response()->json(get_string('success_activate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Making Featured
    public function makeFeatured(Request $request, $id){

        if($request->ajax()) {
            $service = Service::findOrFail($id);
            $service->featured = 1;
            $service->touch();
            $service->save();
            return response()->json(get_string('success_service_featured'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Make Default
    public function makeDefault(Request $request, $id){

        if($request->ajax()) {
            $service = Service::findOrFail($id);
            $service->featured = 0;
            $service->touch();
            $service->save();
            return response()->json(get_string('success_service_default'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Deactivating post
    public function deactivate(Request $request, $id){

        if($request->ajax()) {
            $service = Service::findOrFail($id);
            $service->status = 0;
            $service->touch();
            $service->save();
            return response()->json(get_string('success_deactivate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Validating the Service upon creating
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

    // Validating the Service upon updating
    public function validateServiceUpdate(Request $request, $id){
        $languages = $this->languages;
        $validator = Validator::make($request->all(), $this->validation_rules, $this->validation_messages);
        $images = Service::findOrFail($id)->images->toArray();

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

            $services = ServiceContent::where([['name', 'LIKE', '%' . $term . '%'],['language_id', '=', $default->id]])->take(5)->get();
            foreach ($services as $service) {
                $results[] = ['id' => $service->id, 'name' => $service->name];
            }
            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching for Services
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';

        $service_ids = ServiceContent::where('name', 'LIKE', '%'.$term.'%')->get()->pluck('service_id');

        $services = Service::whereIn('id', $service_ids)->orderBy('created_at','desc')->paginate(10);

        return view('admin.service.search', compact('services'));
    }

    // Helper function for delete
    public function delete($id){

        // Getting the post
        $service = Service::findOrFail($id);

        // Unlinking the images
        if($service->images){
            foreach($service->images as $image){
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
            $service->content($language->id)->delete();
        }

        // Deleting the post
        $service->delete();
    }
}
