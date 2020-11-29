<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'thread_id', 'user'];

    // Return the thread this message belongs
    public function thread(){
    	return $this->belongsTo('App\Models\Admin\MessageThread', 'thread_id');
    }
}
