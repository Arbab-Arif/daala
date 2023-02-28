<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_id' => 1,
            'country_id' => 1,
            'city_id' => 1,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'phone' => $this->faker->phoneNumber,
            'picture' => 'default.jpg',
            'postal_code' => $this->faker->postcode,
            'cnic' => '421017832892873',
            'address' => $this->faker->address,
            'status' => 1
        ];
    }
}
