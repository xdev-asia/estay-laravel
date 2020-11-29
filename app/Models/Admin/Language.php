<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    // No timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
       'code', 'language', 'flag'
    ];

    // Get flag link
    public function getFlagAttribute($value){
        return '/assets/images/flags/'. $value;
    }
}
