<?php

namespace App\Http\Controllers\Admin;

use App\Common\Utility;
use App\Models\Admin\Language;
use App\Models\Admin\Page;
use App\Models\Admin\PageContent;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminPageController extends Controller
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
        $pages = Page::orderBy('created_at','desc')->paginate(10);
        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = $this->languages;
        return view('admin.page.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $languages = $this->languages;
        foreach($languages as $language) {
            $this->validateTitle($request, $language->id);
        }
        $data['status'] = 1;
        $data['user_id'] = $request->user_id;
        $default_language = Language::where('default', 1)->first();
        $data['alias'] = Utility::alias($request->title[$default_language->id], [], 'page');
        $page = Page::create($data);

        foreach($languages as $language) {

            $data['title'] = $request->title[$language->id];

            // Getting content from textarea
            if($request->body[$language->id]) {
                $body = saveContentTextarea($request->body[$language->id]);
                $data['content'] = $body['html'];
            }else{
                $data['content'] = '';
            }

            // Linking images for this page, so later can be deleted
            if(isset($body['images'])){
                foreach ($body['images'] as $image) {
                    Image::create(['image' => $image, 'imageable_id' => $page->id, 'imageable_type' => 'App\Models\Admin\Page']);
                }
            }
            $data['page_id'] = $page->id;
            $data['language_id'] = $language->id;
            PageContent::create($data);
        }


        return redirect('admin/page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Why do we need to show page's page? You will see it in the front-end.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $languages = $this->languages;
        return view('admin.page.edit', compact('page', 'languages'));
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
        // Validation
        $languages = $this->languages;
        foreach($languages as $language) {
            $this->validateTitle($request, $language->id);
        }

        // We get the page
        $page = Page::findOrFail($id);

        $old_images = [];
        $new_images = [];
        // Loop through the languages content
        foreach($languages as $language){
            $body = [];
            $data['title'] = $request->title[$language->id];
            if($request->body[$language->id]) {
                $body = saveContentTextarea($request->body[$language->id]);
                $data['content'] = $body['html'];
            }else{
                $data['content'] = '';
            }

            // Linking images for this language, so later can be deleted
            if(isset($body['images'])){
                foreach ($body['images'] as $image) {
                    $new_images[] = $image;
                    Image::create(['image' => $image, 'imageable_id' => $page->id, 'imageable_type' => 'App\Models\Admin\Page']);
                }
            }
            $old_images[] = isset($body['old_images']) ? $body['old_images'] : '';
            $new_images[] = isset($body['images']) ? $body['images'] : '';
            $data['page_id'] = $id;
            $data['language_id'] = $language->id;

            // Update the Blog Content
            $blog = PageContent::where(['language_id' => $language->id, 'page_id' => $id])->first();
            $default_language = Language::where('default', 1)->first();
            $blog->update($data);
        }

        // Deleting the Unused pictures
        $images = $page->images;
        if($images){
            foreach($images as $image){
                if(!in_array_r($image->image, $old_images) && !in_array_r($image->image, $new_images)){
                    $file = public_path() .'/images/data/'. $image->image;
                    $image->delete();
                    if(File::exists($file)){
                        File::delete($file);
                    }
                }
            }
        }

        // Updating the post
        $data['status'] = isset($request->status) ? 1 : 0;

        // Update Alias
        if($request->alias){
            if($request->alias == ''){
                $data['alias'] = $page->alias;
            }else{
                $alias = Utility::fixAlias($request->alias);
                $c = count(Page::where('alias', 'LIKE', '%'. $alias .'%')->where('id', '<>', $page->id)->get());
                if($c){
                    $data['alias'] = $alias .'-'. $c;
                }else{
                    $data['alias'] = $alias;
                }
            }
        }

        $page->update($data);

        return redirect('admin/page');
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

    // Activating page
    public function activate(Request $request, $id){

        if($request->ajax()) {
            $page = Page::findOrFail($id);
            $page->status = 1;
            $page->touch();
            $page->save();
            return response()->json(get_string('success_activated'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Deactivating page
    public function deactivate(Request $request, $id){

        if($request->ajax()) {
            $page = Page::findOrFail($id);
            $page->status = 0;
            $page->touch();
            $page->save();
            return response()->json(get_string('success_deactivated'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

// Validating the title
    public function validateTitle(Request $request, $id){
        $this->validate($request, [
            'title.'.$id.'' => 'required|min:5',
            'body.'.$id.'' => 'max:5000',
        ],[
            'title.'.$id.'.required'    => get_string('required_field'),
            'title.'.$id.'.min'         => get_string('min_5'),
        ]);
    }

    // Autocomplete
    public function autocomplete(Request $request){

        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];
            $default = Language::where('default', 1)->first();

            $pages = PageContent::where([['title', 'LIKE', '%' . $term . '%'],['language_id', '=', $default->id]])->take(5)->get();
            foreach ($pages as $page) {
                $results[] = ['id' => $page->page_id, 'title' => $page->title];
            }
            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching page pages
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';

        $page_ids = PageContent::where('title', 'LIKE', '%'.$term.'%')->get()->pluck('page_id');
        $pages = Page::whereIn('id', $page_ids)->orderBy('created_at','desc')->paginate(10);
        return view('admin.page.search', compact('pages'));
    }

    // Helper function for delete
    public function delete($id){

        // Getting the page
        $page = Page::findOrFail($id);

        // Delete Language strings
        $languages = $this->languages;
        foreach($languages as $language){
            $page->content($language->id)->delete();
        }

        // Unlinking the images
        foreach($page->images as $image){
            $file = public_path() .'/images/data/'. $image->image;
            if(File::exists($file)){
                File::delete($file);
            }
            $image->delete();
        }

        // Deleting the page
        $page->delete();
    }
}
