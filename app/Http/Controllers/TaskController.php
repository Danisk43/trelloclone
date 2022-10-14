<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;


class TaskController extends Controller
{
    function showAllTasks(){
        return TaskService::showAllTasks();
    }

    function addTask(Request $req)
    {
        return TaskService::addTask($req);
    }

    function showTask($project_id,$task_id){
        return TaskService::showTask($project_id,$task_id);
    }

    function updateTask(Request $req,$project_id,$task_id){
        TaskService::updateTask($req,$project_id,$task_id);
    }

    function deleteTask($project_id,$task_id){
        TaskService::deleteTask($project_id,$task_id);
    }
    
}
