<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustPermission;

class Company extends Model
{
    
    /**
     * Get the Refferrals for the user. // test 
     */

    public function companyhasOne()
    {
        return $this->belongsTo('App\User');
    }

    public function companyhasMany()
    {
        return $this->hasMany('App\Company');
    }

    //Company belongs to a user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function link1()
    {
        return $this->hasMany('App\Company');
    }
}
