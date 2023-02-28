<?php

namespace App\Traits;

use App\Models\UserRequest;

trait HasRevenue
{

    public function userRequest()
    {
        return $this->hasMany(UserRequest::class);
    }

    public function getRevenueAttribute()
    {
        return $this->userRequest->sum('amount');
    }
}
