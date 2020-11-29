<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Disable timestamps
    public $timestamps = false;

    // Enable columns to be filled with data
    protected $fillable = [
        'featured_image', 'alias', 'home_image', 'featured', 'order',
    ];

    // Getting the content - Default Language
    public function contentDefault(){
        $default = Language::where('default', 1)->first();
        return $this->hasOne('App\Models\Admin\LocationContent')->where('language_id', $default->id);
    }

    // Getting the content all Languages
    public function content($language_id = 1){
        return $this->hasOne('App\Models\Admin\LocationContent')->where('language_id', $language_id)->first();
    }

    // Getting the content all Languages
    public function contentload(){
        return $this->hasOne('App\Models\Admin\LocationContent');
    }

    public function getFeaturedImageAttribute($value){
        if($value){
            return '/images/data/'. $value;
        }else{
            return '';
        }
    }

    public function getHomeImageAttribute($value){
        if($value){
            return '/images/data/'. $value;
        }else{
            return '';
        }
    }
}
