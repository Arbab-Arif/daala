<?php

namespace Database\Factories;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'width' => '12',
            'height' =>  '12',
            'breath' => '23',
            'per_km' => '99',
            'per_min' => '88',
            'base_distance' => '12',
            'commission' => '566',
            'description' => 'description',
            'status' => 1
        ];
    }
}
