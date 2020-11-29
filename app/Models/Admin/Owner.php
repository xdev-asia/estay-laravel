<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    // Disable timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'user_id', 'active_balance', 'pending_balance', 'first_name', 'phone', 'last_name', 'address', 'city', 'state', 'zip', 'country', 'logo', 'points'
    ];

    // Add prefix to the avatar column when retrieved from db
    public function getLogoAttribute($value){
        return '/images/owner/' . $value;
    }

    // Return user data for this owner
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // Return owners properties
    public function property(){
        return $this->belongsTo('App\Models\Admin\Property');
    }

    // Return owners properties
    public function service(){
        return $this->belongsTo('App\Models\Admin\Service');
    }

    public function propertyCountRelation(){
        return $this->property()->selectRaw('id, count(*) as count')->groupBy('id');
    }

    public function getPropertyCountAttribute(){
        return $this->propertyCountRelation->first() ? $this->propertyCountRelation->first()->count : 0;
    }

    public function serviceCountRelation(){
        return $this->service()->selectRaw('id, count(*) as count')->groupBy('id');
    }

    public function getServiceCountAttribute(){
        return $this->serviceCountRelation->first() ? $this->serviceCountRelation->first()->count : 0;
    }
}
