<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    // Disable timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'feature'
    ];
    // Storing arrays in base
    protected $casts = [
        'feature' => 'array',
    ];

}
