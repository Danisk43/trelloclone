<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;
use Validator;


class TaskController extends Controller
{
    public function showAllTasks(){
        return TaskService::showAllTasks();
    }

    public function addTask(Request $req,$id)
    {
        $validator = Validator::make($req->all(), [
            'title' => 'required|max:20',
            'description' => 'required|max:100',
            'status_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        return TaskService::addTask($req,$id);
    }

    public function showTask($project_id,$task_id){
        return TaskService::showTask($project_id,$task_id);
    }

    public function updateTask(Request $req,$project_id,$task_id){
        TaskService::updateTask($req,$project_id,$task_id);
    }

    public function deleteTask($project_id,$task_id){
        TaskService::deleteTask($project_id,$task_id);
    }
    
}
