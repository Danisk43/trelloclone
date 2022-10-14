<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;


class ProjectUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'project_id' => $this->faker->randomElement(Project::pluck('id')),
        ];
    }
}
