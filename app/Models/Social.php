<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
    	'social_type', 'social_user_id', 'user_id', 
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
