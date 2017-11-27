<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustPermission;

class myCompany extends Model
{
    //
    /**
     * Get the Refferrals for the user.
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function companies()
    {
        return $this->hasMany('App\myCompany');
    }

    public function getCompanyUsername()
    {
        return User::where('id', $this->user_id)->first()->name;
    }

    

}
