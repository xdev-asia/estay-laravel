<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // Allow columns to be filled with data
    protected $fillable = [
        'user_id', 'status', 'alias'
    ];

    // Returning the post's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Getting the images in the post content
    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    // Getting the content - Default Language
    public function contentDefault(){
        $default = Language::where('default', 1)->first();
        return $this->hasOne('App\Models\Admin\PageContent')->where('language_id', $default->id);
    }

    // Getting the content all Languages
    public function content($language_id){
        return $this->hasOne('App\Models\Admin\PageContent')->where('language_id', $language_id);
    }

    // Getting the content all Languages
    public function contentload(){
        return $this->hasOne('App\Models\Admin\PageContent');
    }

    public function getImageAttribute($value){
        if($value == 'no_image.jpg'){
            return '/images/'. $value;
        }else{
            return '/images/data/'. $value;
        }
    }
}
