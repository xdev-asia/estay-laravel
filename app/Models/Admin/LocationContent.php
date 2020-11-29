<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class LocationContent extends Model
{
    // Disable timestamps
    public $timestamps = false;

    // Enable columns to be filled with data
    protected $fillable = [
        'location', 'description', 'location_id', 'language_id'
    ];

    // Get the Service Category for the content
    public function location(){
        return $this->belongsTo('App\Models\Admin\Location');
    }
}
