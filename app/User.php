<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'usertype',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * Get the Refferrals for the user.
     */

    public function link1()
    {
        return $this->hasMany('App\Referral');
    }

     public function link2()
    {
        return $this->hasMany('App\Company');
    }

    //A user has many Referrals
    public function referrals()
    {
        return $this->hasMany('App\referral');
    }

    //A user has many Companies
    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    


    public function company()
    {
        return $this->belongsToMany('Company')->withTimestamps();
    }

}
