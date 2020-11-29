<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    // Allow column to be filled with data
    protected $fillable = [
        'user_id', 'transaction', 'points', 'method', 'price'
    ];

    // Get purchase's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
