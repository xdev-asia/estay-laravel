<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Allow columns to be filled with data
    protected $fillable = [
        'username', 'email', 'password', 'role_id', 'is_active'
    ];

    // Hidden fields
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Return the role of a user
    public function role(){
       return $this->belongsTo('App\Models\Role');
    }

    // Is user admin and active
    public function isAdmin(){
        if($this->role->id == 1 && $this->is_active){
            return true;
        }else return false;
    }

    // Is user admin and active
    public function isOwner(){
        if($this->role->id == 2 && $this->is_active){
            return true;
        }else return false;
    }

    // Is user user and active
    public function isUser(){
        if($this->role->id == 3 && $this->is_active){
            return true;
        }else return false;
    }

    // Return admin's data
    public function admin(){
        return $this->hasOne('App\Models\Admin\Admin');
    }

    // Return owner's data
    public function owner(){
        return $this->hasOne('App\Models\Admin\Owner');
    }
    // Return user's data
    public function user(){
        return $this->hasOne('App\Models\UserInfo');
    }

    // Return corresponding information about the user
    public function info(){
        $role_id = $this->role_id;
        switch($role_id){
            case 1: return $this->hasOne('App\Models\Admin\Admin'); break;
            case 2: return $this->hasOne('App\Models\Admin\Owner'); break;
            case 3: return $this->hasOne('App\Models\UserInfo'); break;
        }
    }
}
