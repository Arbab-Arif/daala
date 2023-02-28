<?php

namespace Database\Factories;

use App\Models\AreaVehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaVehicleTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaVehicleType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_type_id'   =>  1,
            'area_id'           =>  1,
            'area_per_km'       =>  90,
            'area_per_min'      =>  90,
            'price'             =>  200
        ];
    }
}
