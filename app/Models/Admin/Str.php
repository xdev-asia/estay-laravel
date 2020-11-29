<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Str extends Model
{
    protected $table = 'strings';

    // Disable timestamps
    public $timestamps = false;

    // Fillabled columns
    protected $fillable = [
      'code', 'string', 'key', 'default', 'is_backend'
    ];
}
