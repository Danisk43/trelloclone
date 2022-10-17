<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Validator;

class TaskService
{
    public function showAllTasks(){
        return Task::users();
    }

    public function addTask($req)
    {
        // $task = new Task;
        // $task->title=$req->title;
        // $task->description=$req->description;
        // $task->status_id=$req->status_id;
        // $task->attachment=$req->attachment;
        // $task->user_id=$req->user_id;
        // $task->project_id=$req->project_id;
        // $task->save();

        return $res = (new Task())->fill([
            'title'=>$req->get('title'),
            'description'=>$req->get('description'),
            'status_id'=>$req->get('status_id'),
            'attachment'=>$req->get('attachment'),
            'user_id'=>Session::get('user_id'),
            'project_id'=>$id,
        ])->save();
    }

    public function showTask($project_id,$task_id){
        return Project::find($project_id)->task();

    }

    public function updateTask($req,$project_id,$task_id){
        $task=Task::find($task_id);
        if($req->has('title')){
            $task->title=$req->title;
        }
        if($req->has('description')){
            $task->description=$req->description;
        }
        if($req->has('status_id')){
            $task->status_id=$req->status_id;
        }
        if($req->has('attachment')){
            $task->attachment=$req->attachment;
        }
        if($req->has('user_id')){
            $task->user_id=$req->user_id;
        }

        // dd($task,$req->get("description"));

        $task->save();
    }

    public function deleteTask($project_id,$task_id){
        $task=Task::find($task_id);
        $task->delete();
    }
    
}
