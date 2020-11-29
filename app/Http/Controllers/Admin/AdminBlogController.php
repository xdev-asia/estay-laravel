<?php

namespace App\Http\Controllers\Admin;

use App\Common\Utility;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogContent;
use App\Models\Admin\Language;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as ImageIn;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminBlogController extends Controller
{
    protected $languages;
    public function __construct(){
        $this->languages = Language::all();
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Blog::orderBy('created_at','desc')->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = $this->languages;
        return view('admin.blog.create', compact('languages'));
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
            $this->validateTitle($request, $language->id);
        }
        $data['status'] = 1;

        // Handling Featured Image
        $file = $request->file('image');
        if(isset($file) && $file->isValid()){
            $name = uniqid() . unique_string() .'.'. $file->getClientOriginalExtension();
            $img = ImageIn::make($file->getRealPath());
            $date = date('M-Y');
            if(!File::exists(public_path() . '/images/data/'. $date)){
                File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
            }
            $img->save(public_path().'/images/data/'. $date .'/'. $name);
            $data['image'] = $date .'/'. $name;
        }else{
            $data['image'] = 'no_image.jpg';
        }

        $data['user_id'] = $request->user_id;
        $default_language = Language::where('default', 1)->first();
        $data['alias'] = Utility::alias($request->title[$default_language->id], [], 'blog');
        $post = Blog::create($data);

        foreach($languages as $language){
            $data['title'] = $request->title[$language->id];

            // Getting content from textarea
            if($request->body[$language->id]) {
                $body = saveContentTextarea($request->body[$language->id]);
                $data['content'] = $body['html'];
            }else{
                $data['content'] = '';
            }
            // Linking images for this post, so later can be deleted
            if(isset($body['images'])){
                foreach ($body['images'] as $image) {
                    Image::create(['image' => $image, 'imageable_id' => $post->id, 'imageable_type' => 'App\Models\Admin\Blog']);
                }
            }

            $data['blog_id'] = $post->id;
            $data['language_id'] = $language->id;
            BlogContent::create($data);
        }

        return redirect('admin/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // Why do we need to show blog post? You will see it in the front-end.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Blog::findOrFail($id);
        $languages = $this->languages;
        return view('admin.blog.edit', compact('post', 'languages'));
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
        // Validation
        foreach($languages as $language) {
            $this->validateTitle($request, $language->id);
        }

        // We get the post
        $post = Blog::findOrFail($id);

        // Handling Featured Image
        $file = $request->file('image');
        if(isset($file) && $file->isValid()){
            $name = uniqid() . unique_string() .'.'. $file->getClientOriginalExtension();
            $img = ImageIn::make($file->getRealPath());
            $date = date('M-Y');
            if(!File::exists(public_path() . '/images/data/'. $date)){
                File::makeDirectory(public_path() . '/images/data/'. $date, 0755, true);
            }
            $img->save(public_path().'/images/data/'. $date .'/'. $name);
            $data['image'] = $date .'/'. $name;

            // Deleting the old featured image
            $file_old = public_path($post->image);
            if(File::exists($file_old) && $file_old != 'no_image.jpg'){
                File::delete($file_old);
            }
        }

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
                    Image::create(['image' => $image, 'imageable_id' => $post->id, 'imageable_type' => 'App\Models\Admin\Blog']);
                }
            }
            $old_images[] = isset($body['old_images']) ? $body['old_images'] : '';
            $new_images[] = isset($body['images']) ? $body['images'] : '';
            $data['blog_id'] = $id;
            $data['language_id'] = $language->id;

            // Update the Blog Content
            $blog = BlogContent::where(['language_id' => $language->id, 'blog_id' => $id])->first();
            $blog->update($data);
        }

        // Deleting the Unused pictures
        $images = $post->images;
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
        $default_language = Language::where('default', 1)->first();

        // Update Alias
        if($request->alias){
            if($request->alias == ''){
                $data['alias'] = $post->alias;
            }else{
                $alias = Utility::fixAlias($request->alias);
                $c = count(Blog::where('alias', 'LIKE', '%'. $alias .'%')->where('id', '<>', $post->id)->get());
                if($c){
                    $data['alias'] = $alias .'-'. $c;
                }else{
                    $data['alias'] = $alias;
                }
            }
        }
        $post->update($data);

        return redirect('admin/blog');
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
            $post = Blog::findOrFail($id);
            $post->status = 1;
            $post->touch();
            $post->save();
            return response()->json(get_string('success_activated'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Deactivating post
    public function deactivate(Request $request, $id){

        if($request->ajax()) {
            $post = Blog::findOrFail($id);
            $post->status = 0;
            $post->touch();
            $post->save();
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
            'title.'.$id.'.required'    => get_string('title_required'),
            'title.'.$id.'.min'         => get_string('min_5'),
        ]);
    }

    // Autocomplete
    public function autocomplete(Request $request){

        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];
            $default = Language::where('default', 1)->first();

            $posts = BlogContent::where([['title', 'LIKE', '%' . $term . '%'],['language_id', '=', $default->id]])->take(5)->get();
            foreach ($posts as $post) {
                $results[] = ['id' => $post->blog_id, 'title' => $post->title];
            }
            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching blog posts
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';

        $post_ids = BlogContent::where('title', 'LIKE', '%'.$term.'%')->get()->pluck('blog_id');

        $posts = Blog::whereIn('id', $post_ids)->orderBy('created_at','desc')->paginate(10);
        return view('admin.blog.search', compact('posts'));
    }

    // Helper function for delete
    public function delete($id){

        // Getting the post
        $post = Blog::findOrFail($id);

        // Delete Language strings
        $languages = $this->languages;
        foreach($languages as $language){
            $post->content($language->id)->delete();
        }

        // Unlinking the images
        foreach($post->images as $image){
            $file = public_path('images/data/'. $image->image);
            if(File::exists($file)){
                File::delete($file);
            }
            $image->delete();
        }

        // Unlinking the featured image
        if($post->image != '/images/no_image.jpg'){
            $file = public_path($post->image);
            if(File::exists($file)){
                File::delete($file);
            }
        }

        // Deleting the post
        $post->delete();
    }

    // Delete Featured Image
    public function deleteFeatured(Request $request, $id)
    {
        if($request->ajax()){
            $post = Blog::findOrFail($id);
            $post->image = '';
            $post->touch();
            $post->save();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
