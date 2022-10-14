<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(20),
            'last_name' => $this->faker->lastName(20),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make($this->faker->password(8,20)), // password
            'is_verified' => $this->faker->boolean,
        ];
    }
}
