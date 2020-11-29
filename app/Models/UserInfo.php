<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    // No timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'user_id'
    ];

}
