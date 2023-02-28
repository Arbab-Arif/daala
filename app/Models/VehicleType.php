<?php

namespace App\Models;

use App\Traits\HasRevenue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory, HasRevenue;

    protected $fillable = [
        'vehicle_category_id',
        'name',
        'width',
        'height',
        'breath',
        'per_km',
        'per_min',
        'base_distance',
        'commission',
        'description',
        'base_fare',
        'base_waiting_time',
        'waiting_time_penalty',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    protected static function booted()
    {
        static::deleting(fn($vehicleType) => $vehicleType->areas()->delete());
    }

    public function areas()
    {
        return $this->hasMany(AreaVehicleType::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class);
    }

    public function userRequest()
    {
        return $this->hasMany(UserRequest::class);
    }
}
