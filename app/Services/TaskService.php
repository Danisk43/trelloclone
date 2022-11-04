<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\Status;
use Validator;
use Illuminate\Support\Facades\Session;


class TaskService
{
    public function showAllTasks($id){
        $project = Project::find($id);	
        // $projects=$projects->projects->pluck('name');
        $project=$project[0]->tasks;
        // $status= Task::find($tasks->id)

        return response()->json([
            "tasks"=>$project,
        ]);
    }

    public function showAllTasksWithStatus($id){
        $status_ids= Status::where('project_id',$id)->get();

        foreach($status_ids as &$s){
            $s->tasks=Task::where('status_id',$s->id)->get();
            // foreach($s->tasks as &$t){
                // echo $t;
                // $users=Task::find($t->id);
                // $users=$users->users;
                // echo $users;
                // $i=0;
                // foreach($users as &$u){
                    // echo $u->first_name;
                //     $users_list[$i]=$u->first_name;
                //     $i++;
                // }
                // $s->tasks->users=$users_list;
            // }
            // dd($users_list);
        }
        // dd($status_ids);
        return $status_ids;
    }

    public function addTask($req)
    {

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
        $task=Task::find($task_id);
        // echo $task;
        $users=$task->users;
        // echo $users;
        return response()->json([
            "task"=>$task,
            // "users"=>$users
        ]);


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

    public function deleteTask($task_id){
        $task=Task::find($task_id);
        $task->delete();
    }
    
}
