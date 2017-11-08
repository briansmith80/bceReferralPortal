<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Models\LaratrustPermission;

class Referral extends Model
{
    //
    /**
     * Get the Refferrals for the user.
     */

    public function referralshasOne()
    {
        return $this->belongsTo('App\User');
    }

    public function referralshasMany()
    {
        return $this->hasMany('App\Referral');
    }
}
