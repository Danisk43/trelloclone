<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Task;


class TaskUserFactory extends Factory
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
            'task_id' => $this->faker->randomElement(Task::pluck('id')),
        ];
    }
}
