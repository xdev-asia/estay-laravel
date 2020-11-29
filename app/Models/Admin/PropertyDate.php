<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PropertyDate extends Model
{
    // Disable timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'property_id', 'dates'
    ];

    // Store dates as an array
    protected $casts = [
      'dates' => 'array'
    ];

}
