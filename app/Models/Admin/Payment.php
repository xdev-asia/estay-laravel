<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    	'user_id', 'payment_method', 'transaction', 'total', 'property_id', 'booking_id', 'data', 'host_commission', 'owner_id'
    ];

    // Get purchase's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Get purchase's user
    public function owner(){
        return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    // Get purchase's user
    public function booking(){
        return $this->belongsTo('App\Models\Admin\Booking');
    }

    // Get purchase's user
    public function property(){
        return $this->belongsTo('App\Models\Admin\Property');
    }
}
