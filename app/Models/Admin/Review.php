<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Allow columns to be filled with data
    protected $fillable = [
        'review', 'status', 'rating', 'property_id', 'service_id', 'user_id'
    ];

    // Return the request's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Return the property
    public function property(){
        return $this->belongsTo('App\Models\Admin\Property');
    }

    // Return the service
    public function service(){
        return $this->belongsTo('App\Models\Admin\Service');
    }

    public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
