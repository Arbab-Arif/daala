<?php

namespace App\Models;

use App\Http\Livewire\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'driver_id',
        'vehicle_type_id',
        'status',
        'canceled',
        'payment_mode',
        'paid',
        'distance',
        'travel_time',
        'start_address',
        'start_latitude',
        'start_longitude',
        'track_distance',
        'track_latitude',
        'track_longitude',
        'track_accuracy',
        'start_at',
        'finished_at',
        'route_key',
    ];

    protected $dates = ['started_at', 'finished_at'];


    public function driver()
    {

        return $this->belongsTo(Driver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function dropOffs()
    {
        return $this->hasMany(UserRequestDropOff::class);
    }
}
