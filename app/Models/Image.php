<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // No timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'image', 'imageable_id', 'imageable_type',
    ];


    // Morph relationship
    public function imageable(){
        return $this->morphTo();
    }
}
