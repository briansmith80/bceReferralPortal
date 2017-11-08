<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyReferral extends Model
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
