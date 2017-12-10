<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    //
    // ///**
    //  * Scope a query to only include popular users.
    //  *
    //  * @param \Illuminate\Database\Eloquent\Builder $query
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    public function scopePopular($query)
    {
        return $query->where('user_id', '>', 1);

    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('status', $type);
    }

}
