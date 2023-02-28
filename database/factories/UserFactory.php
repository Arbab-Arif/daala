<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'    =>   $this->faker->phoneNumber,
            'customer_type'    =>   $this->faker->name,
            'picture'    =>   'default.jpg',
            'postal_code'    =>   $this->faker->numberBetween(10),
            'country_id'    =>   1,
            'city_id'    =>   1,
            'address'    =>   $this->faker->address,
            'status'    =>   1,
            'remember_token' => Str::random(10),
        ];
    }
}
