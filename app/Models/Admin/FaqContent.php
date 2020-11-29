<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class FaqContent extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'language_id', 'faq_id', 'question', 'answer'
    ];
}
