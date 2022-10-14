<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Task;


class CommentFactory extends Factory
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
            'description'=> $this->faker->text(50),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'task_id' => $this->faker->randomElement(Task::pluck('id')),
        
        ];
    }
}
