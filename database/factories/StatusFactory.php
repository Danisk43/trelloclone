<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;


class StatusFactory extends Factory
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
            'type'=> $this->faker->text(10),
            'project_id' => $this->faker->randomElement(Project::pluck('id')),
        ];
    }
}
