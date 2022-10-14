<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Status;
use App\Models\ProjectUser;
use App\Models\TaskUser;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Project::factory(20)->create();
        $projectIds = Project::pluck('id');
        for($i=0;$i<count($projectIds);$i++){
                if($i%4==0){
                    DB::table('statuses')->insert([
                        'type'=>'Unassigned',
                        'project_id'=>$projectIds[$i],
                    ]);
                }
                elseif($i%3==0){
                    DB::table('statuses')->insert([
                        'type'=>'Work In Progress',
                        'project_id'=>$projectIds[$i],
                    ]);
                }
                elseif($i%2==0){
                    DB::table('statuses')->insert([
                        'type'=>'Testing',
                        'project_id'=>$projectIds[$i],
                    ]);
                }
                else{
                    DB::table('statuses')->insert([
                        'type'=>'Completed',
                        'project_id'=>$projectIds[$i],
                    ]);
                }
        }
        Task::factory(60)->create();
        // Status::factory(5)->create();
        ProjectUser::factory(30)->create();
        Comment::factory(30)->create();
        TaskUser::factory(30)->create();

    }
}
