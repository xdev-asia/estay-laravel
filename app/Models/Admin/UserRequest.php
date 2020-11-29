<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{	
    // Allow columns to be filled with data
    protected $fillable = [
        'request', 'completed', 'user_id'
    ];

    // Return the request's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
