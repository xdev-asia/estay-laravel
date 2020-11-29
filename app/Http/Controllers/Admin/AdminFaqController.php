<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Language;
use App\Models\Admin\Faq;
use App\Models\Admin\FaqContent;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminFaqController extends Controller
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
        $faqs = Faq::paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = $this->languages;
        return view('admin.faq.create', compact('languages'));
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
        $data['global'] = 0;
        $faq = Faq::create($data);

        foreach($languages as $language) {

            $data['question'] = $request->title[$language->id];
            $data['answer'] = $request->body[$language->id];
            $data['faq_id'] = $faq->id;
            $data['language_id'] = $language->id;
            FaqContent::create($data);
        }


        return redirect('admin/faq');
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
        $faq = Faq::findOrFail($id);
        $languages = $this->languages;
        return view('admin.faq.edit', compact('faq', 'languages'));
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

        // We get the faq
        $faq = Faq::findOrFail($id);

        // Loop through the languages content
        foreach($languages as $language){
            
            $data['question'] = $request->title[$language->id];
            $data['answer'] = $request->body[$language->id];
            $data['faq_id'] = $faq->id;
            $data['language_id'] = $language->id;

            // Update the faq Content
            $faq_c = FaqContent::where(['language_id' => $language->id, 'faq_id' => $id])->first();
            $default_language = Language::where('default', 1)->first();
            $faq_c->update($data);
        }

        unset($data);
        $data['global'] = 0;
        $faq->update($data);

        return redirect('admin/faq');
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

    // Helper function for delete
    public function delete($id){

        // Getting the faq
        $faq = Faq::findOrFail($id);

        // Delete Language strings
        $languages = $this->languages;
        foreach($languages as $language){
            $faq->content($language->id)->delete();
        }

        // Deleting the faq
        $faq->delete();
    }
}
