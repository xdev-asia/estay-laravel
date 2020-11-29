<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogContent extends Model
{
    // No timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'blog_id', 'language_id', 'title', 'content'
    ];

    // Get the post for the content
    public function post(){
        return $this->belongsTo('App\Models\Admin\Blog');
    }
}
