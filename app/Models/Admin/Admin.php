<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // No timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'country', 'avatar', 'user_id',
    ];

    // Add prefix to the avatar column when retrieved from db
    public function getAvatarAttribute($value){
        return '/images/admin/' . $value;
    }

}
