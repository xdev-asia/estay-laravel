<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    // Allow columns to be filled with data
    protected $fillable = [
        'user_id', 'status', 'image', 'alias'
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
        return $this->hasOne('App\Models\Admin\BlogContent')->where('language_id', $default->id);
    }

    // Getting the content all Languages
    public function content($language_id = 1){
        return $this->hasOne('App\Models\Admin\BlogContent')->where('language_id', $language_id)->first();
    }

    // Getting the content all Languages
    public function contentload(){
        return $this->hasOne('App\Models\Admin\BlogContent');
    }

    public function getImageAttribute($value){
        if($value != ''){
            if($value == 'no_image.jpg'){
                return '/images/'. $value;
            }else{
                return '/images/data/'. $value;
            }
        }else{
            return '';
        }
    }

    public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
