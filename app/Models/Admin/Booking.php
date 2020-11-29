<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Allow columns to be filled with data
    protected $fillable = [
        'property_id', 'start_date', 'end_date', 'guest_number', 'user_data', 'total', 'user_id', 'owner_id', 'status'
    ];

    // Allow to be stored as array
    protected $casts = [
        'user_data' => 'array'
    ];

    // Get booking's property
    public function property(){
        return $this->belongsTo('App\Models\Admin\Property');
    }

    // Get booking's property
    public function service(){
        return $this->belongsTo('App\Models\Admin\Service');
    }

    // Get booking's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function owner(){
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

}
