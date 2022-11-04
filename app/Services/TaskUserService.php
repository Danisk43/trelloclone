<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\TaskUser;
use App\Models\Task;
use App\Models\Project;

use Validator;
use Illuminate\Support\Facades\Session;


class TaskUserService
{
    public function showUsers($id){
        $task = Task::find($id);
        $project=Project::find($task->project->id);
        return $project->users;
    }

    public function addUser($task_id,$user_id){
        return $res = (new TaskUser())->fill([
            'task_id'=>$task_id,
            'user_id'=>$user_id,
        ])->save();

        
    }

    public function removeUser($task_id,$user_id){
        $user=TaskUser::where('task_id',$task_id)->where('user_id',$user_id);
        $user->delete();
    }

}