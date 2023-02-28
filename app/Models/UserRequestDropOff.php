<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequestDropOff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_request_id',
        'address',
        'latitude',
        'longitude',
        'complete_address',
        'name',
        'mobile'
    ];
}
