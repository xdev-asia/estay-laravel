<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Allow columns to be filled with data
    protected $fillable = [
        'user_id', 'status', 'images', 'category_id', 'location_id', 'location', 'contact',
        'social', 'business_hours', 'featured', 'video', 'features', 'alias', 'meta_keywords', 'meta_description', 'meta_title',
    ];

    // Storing arrays in base
    protected $casts = [
        'features' => 'array',
        'location' => 'array',
        'contact' => 'array',
        'social' => 'array',
        'images' => 'array',
        'business_hours' => 'array',
    ];

    // Returning the post's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Getting the images in the post content
    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    // Getting the category
    public function category(){
        return $this->belongsTo('App\Models\Admin\Category');
    }

    // Getting the location
    public function ser_location(){
        return $this->belongsTo('App\Models\Admin\Location', 'location_id', 'id');
    }

    // Getting the content - Default Language
    public function contentDefault(){
        $default = Language::where('default', 1)->first();
        return $this->hasOne('App\Models\Admin\ServiceContent')->where('language_id', $default->id);
    }

    // Getting the content all Languages
    public function content($language_id = 1){
        return $this->hasOne('App\Models\Admin\ServiceContent')->where('language_id', $language_id)->first();
    }

    // Getting the content all Languages
    public function contentload(){
        return $this->hasOne('App\Models\Admin\ServiceContent');
    }

    // Add Attribute to the images
    public function getImageAttribute($value){
        if($value == 'no_image.jpg'){
            return '/images/'. $value;
        }else{
            return '/images/data/'. $value;
        }
    }

    public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
