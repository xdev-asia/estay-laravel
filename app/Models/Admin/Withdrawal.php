<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
    	'user_id', 'method', 'amount', 'status', 'data'
    ];

    // Get purchase's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
