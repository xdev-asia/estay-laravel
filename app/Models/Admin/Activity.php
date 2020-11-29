<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // Allow columns to be filled with data
    protected $fillable = [
        'user_id', 'activity', 'points', 'property_id', 'service_id', 'end_date'
    ];

    // Get activity's user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Get activity's property
    public function property(){
        return $this->belongsTo('App\Models\Admin\Property');
    }

    // Get activity's user
    public function service(){
        return $this->belongsTo('App\Models\Admin\Service');
    }
}
