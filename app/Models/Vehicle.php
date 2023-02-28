<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_name',
        'vehicle_type_id',
        'vehicle_cc',
        'vehicle_no',
        'license_no',
        'make',
        'model',
        'year',
        'color',
        'vehicle_image',
        'cnic_front_image',
        'cnic_back_image',
        'license_front_image',
        'license_back_image',
        'vehicle_reg_image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function driver() {
        return $this->hasOne(Driver::class);
    }

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class,);
    }
}
