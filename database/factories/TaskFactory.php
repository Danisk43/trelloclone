<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;
use App\Models\Status;



class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $project_id=$this->faker->randomElement(Project::pluck('id'));
        $status_id=$this->faker->randomElement(Status::pluck('id'));
        return [
            'title' => $this->faker->text(20),
            'description'=> $this->faker->text(100),
            'attachment'=>$this->faker->text(20),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'project_id' => $project_id,
            'status_id' => $status_id,
        ];
    }
}
