<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Task;
use Validator;

class TaskService
{
    function showAllTasks(){
        return Task::all();
    }

    function addTask($req)
    {
        $validator = Validator::make($req->all(), [
            'title' => 'required|max:20',
            'description' => 'required|max:100',
            'status_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $task = new Task;
        $task->title=$req->title;
        $task->description=$req->description;
        $task->status_id=$req->status_id;
        $task->attachment=$req->attachment;
        $task->user_id=$req->user_id;
        $task->project_id=$req->project_id;
        $task->save();
    }

    function showTask($project_id,$task_id){
        return Task::find($task_id);
    }

    function updateTask($req,$project_id,$task_id){
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

    function deleteTask($project_id,$task_id){
        $task=Task::find($task_id);
        $task->delete();
    }
    
}
