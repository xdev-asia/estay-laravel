<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model
{

    protected $fillable = ['user_id', 'owner_id', 'status', 'closed'];

    // Return the messages in the thread
    public function messages(){
    	return $this->hasMany('App\Models\Admin\Message', 'thread_id');
    }

    // Return the user (sender) of the thread
    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

    // Return the owner (recieved) of the thread
    public function owner(){
    	return $this->belongsTo('App\Models\User', 'owner_id');
    }
}
