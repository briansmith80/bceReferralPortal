<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustPermission;

class Company extends Model
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
        return $this->hasMany('App\Company');
    }
}
