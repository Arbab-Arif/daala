<?php

namespace App\Models;

use App\Traits\HasRevenue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory, HasRevenue;

    protected $fillable = [
        'vehicle_id',
        'country_id',
        'city_id',
        'area_id',
        'name',
        'email',
        'password',
        'phone',
        'picture',
        'postal_code',
        'cnic',
        'address',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    protected $hidden = [
        'password',
    ];

    protected $with = [
        'vehicle'
    ];

    public static function booted()
    {
        static::deleting(fn($driver) => $driver->vehicle()->delete());
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function userRequest()
    {
        return  $this->hasMany(UserRequest::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(CityArea::class);
    }
    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class);
    }
}

