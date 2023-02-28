<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_name'          =>  $this->faker->name,
            'vehicle_cc'            =>  $this->faker->randomDigit,
            'vehicle_no'            =>  $this->faker->randomDigit,
            'license_no'            =>  $this->faker->randomDigit,
            'make'                  =>   $this->faker->name,
            'model'                 =>   $this->faker->name,
            'year'                  =>   $this->faker->year,
            'color'                 =>   $this->faker->colorName,
            'vehicle_image'         =>   'default.jpg',
            'cnic_front_image'      =>   'default.jpg',
            'cnic_back_image'       =>   'default.jpg',
            'license_front_image'   =>   'default.jpg',
            'license_back_image'    =>   'default.jpg',
            'vehicle_reg_image'     =>   'default.jpg',
            'status'                =>   1,
        ];
    }
}
