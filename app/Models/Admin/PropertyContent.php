<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PropertyContent extends Model
{
    // Disable timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'name', 'features', 'description', 'property_id', 'language_id'
    ];

    // Storing arrays in base
    protected $casts = [
        'features' => 'array',
    ];

    // Get the Service Category for the content
    public function property(){
        return $this->belongsTo('App\Models\Admin\Property');
    }
}
