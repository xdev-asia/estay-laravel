<?php

namespace App\Http\Controllers\Admin;

use App\Common\Utility;
use App\Models\Admin\Language;
use App\Models\Admin\Category;
use App\Models\Admin\CategoryContent;
use App\Models\Admin\Property;
use App\Models\Admin\Service;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminCategoryController extends Controller
{
    protected $languages;
    public function __construct(){
        $this->languages = Language::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('order', 'asc')->paginate(10);
        return view('admin.taxonomy.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = $this->languages;
        return view('admin.taxonomy.category.create', compact('languages'));
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
        foreach($languages as $language) {
            // Validation
            $this->validateCat($request, $language->id);
        }

        $data = [];
        // Handing the Featured image
        $file = $request->file('featured_image');
        if(isset($file) && $file->isValid()){
            $name = uniqid() . unique_string() .'.'. $file->getClientOriginalExtension();
            $img = Image::make($file->getRealPath());
            $date = date('M-Y');
            if(!File::exists(public_path() . '/images/data/'. $date)){
                File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
            }
            $img->save(public_path().'/images/data/'. $date .'/'. $name);
            $data['featured_image'] = $date .'/'. $name;
        }


        $default_language = Language::where('default', 1)->first();
        $data['map_icon'] = $request->map_icon;
        $data['order'] = $request->order ? $request->order: 0;
        $data['alias'] = Utility::alias($request->name[$default_language->id], [], 'category');
        $category = Category::create($data);
        unset($data);
        foreach($languages as $language) {
            // Getting name
            $data['name'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['category_id'] = $category->id;
            $data['language_id']  = $language->id;
            CategoryContent::create($data);

        }

        return redirect('admin/taxonomy/category');
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
        $category = Category::findOrFail($id);
        $languages = $this->languages;
        return view('admin.taxonomy.category.edit', compact('category', 'languages'));
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
        foreach($languages as $language) {
            // Validation
            $this->validateCatUpdate($request, $id, $language->id);
        }

        // We get the category
        $category = Category::findOrFail($id);

        $data = [];
        // Handing the Featured image
        $file = $request->file('featured_image');
        if(isset($file) && $file->isValid()){
            if(strpos($category->featured_image, 'no_image.jpg') === FALSE && File::exists(public_path() . $category->featured_image)){
                File::delete((public_path() . $category->featured_image));
            }
            $name = uniqid() . unique_string() .'.'. $file->getClientOriginalExtension();
            $img = Image::make($file->getRealPath());
            $date = date('M-Y');
            if(!File::exists(public_path() . '/images/data/'. $date)){
                File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
            }
            $img->save(public_path().'/images/data/'. $date .'/'. $name);
            $data['featured_image'] = $date .'/'. $name;
        }

        $data['map_icon'] = $request->map_icon;
        $data['order'] = $request->order ? $request->order : $category->order;
        // Updating the category
        $default_language = Language::where('default', 1)->first();

        // Update Alias
        if($request->alias){
            if($request->alias == ''){
                $data['alias'] = $category->alias;
            }else{
                $alias = Utility::fixAlias($request->alias);
                $c = count(Category::where('alias', 'LIKE', '%'. $alias .'%')->where('id', '<>', $category->id)->get());
                if($c){
                    $data['alias'] = $alias .'-'. $c;
                }else{
                    $data['alias'] = $alias;
                }
            }
        }

        
        $category->update($data);

        // Updating the Content
        foreach($languages as $language) {

            unset($data);
            // Getting name
            $data['name'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['category_id'] = $category->id;
            $data['language_id']  = $language->id;

            // Update the Category Content
            $category_content = CategoryContent::where(['language_id' => $language->id, 'category_id' => $id])->first();
            $category_content->update($data);
        }

        return redirect('admin/taxonomy/category');
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
            if(Property::where('category_id', $id)->first() || Service::where('category_id', $id)->first()){
                return response()->json(get_string('connected_item'), 400);
            }else {
                $this->delete($id);
            }
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
                if(Property::where('category_id', $id)->first() || Service::where('category_id', $id)->first()){
                    return response()->json(get_string('connected_item'), 400);
                }else {
                    $this->delete($id);
                }
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Validating the category on craete
    public function validateCat(Request $request, $lang_id){
        $this->validate($request, [
            'name.'.$lang_id.'' => 'required',
            'description.'.$lang_id.'' => 'max:300',
            'featured_image.'.$lang_id.'' => 'dimensions:min_width=1920,min_height=600'
        ],[
            'name.'.$lang_id.'.required'    => get_string('required_field'),
            'featured_image.'.$lang_id.'.dimension'      => get_string('min_dimension_featured'),
            'description.'.$lang_id.'.max'  => get_string('description_max_300')
        ]);
    }

    // Validating the category on update
    public function validateCatUpdate(Request $request, $id, $lang_id){
        $this->validate($request, [
            'name.'.$lang_id.'' => 'required',
            'description.'.$lang_id.'' => 'max:300',
            'featured_image.'.$lang_id.'' => 'dimensions:min_width=1920,min_height=600'
        ],[
            // 'name.'.$lang_id.'.required'    => get_string('required_field'),
            'name.'.$lang_id.'.unique'      => get_string('not_unique_field'),
            'featured_image.'.$lang_id.'.dimension'      => get_string('min_dimension_featured'),
            'description.'.$lang_id.'.max'  => get_string('description_max_300')
        ]);
    }

    // Autocomplete
    public function autocomplete(Request $request){

        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];
            $default = Language::where('default', 1)->first();

            $categories = CategoryContent::where([['name', 'LIKE', '%' . $term . '%'],['language_id', '=', $default->id]])->take(5)->get();
            foreach ($categories as $category) {
                $results[] = ['id' => $category->category_id, 'name' => $category->name];
            }

            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching category categories
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';

        $category_ids = CategoryContent::where('name', 'LIKE', '%'.$term.'%')->get()->pluck('category_id');

        $categories = Category::whereIn('id', $category_ids)->orderBy('order', 'asc')->paginate(10);

        return view('admin.taxonomy.category.search', compact('categories'));
    }

    // Helper function for delete
    public function delete($id){

        // Getting the category
        $category = Category::findOrFail($id);

        // Deleting the Content
        $languages = $this->languages;
        foreach($languages as $language){
            $category->content($language->id)->delete();
        }

        // Delete the Featured Image
        if(strpos($category->featured_image, 'no_image.jpg') === FALSE && File::exists(public_path() . $category->featured_image)){
            File::delete((public_path() . $category->featured_image));
        }

        // Deleting the category
        $category->delete();
    }

    // Delete Featured Image
    public function deleteFeatured(Request $request, $id)
    {
        if($request->ajax()){
            $category = Category::findOrFail($id);
            if(strpos($category->featured_image, 'no_image.jpg') === FALSE && File::exists(public_path() . $category->featured_image)){
                File::delete((public_path() . $category->featured_image));
            }
            $category->featured_image = null;
            $category->save();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
