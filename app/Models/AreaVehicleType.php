<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaVehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'area_id',
        'area_per_km',
        'area_per_min',
        'price'
    ];
}
