<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'global'
    ];

    // Getting the content - Default Language
    public function contentDefault(){
        $default = Language::where('default', 1)->first();
        return $this->hasOne('App\Models\Admin\FaqContent')->where('language_id', $default->id);
    }

    // Getting the content all Languages
    public function content($language_id = 1){
        return $this->hasOne('App\Models\Admin\FaqContent')->where('language_id', $language_id)->first();
    }
}
