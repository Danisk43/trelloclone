<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\Status;
use App\Models\User;

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
            "status"=>200
        ]);
    }

    public function showAllTasksWithStatus($id){
        $status_ids= Status::where('project_id',$id)->get();
        // echo $status_ids;
        foreach($status_ids as &$s){
            $s->tasks=Task::where('status_id',$s->id)->where('project_id',$id)->get();
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
        // return $status_ids;
        return response()->json([
            "result"=>$status_ids,
            "status"=>200
            // "users"=>$users
        ]);
    }

    public function addTask($req,$id)
    {
        // $user_id = Session::get('user_id');
        $token = $req->header('token');
        $payload=JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256'));
        return $res = (new Task())->fill([
            'title'=>$req->get('title'),
            'description'=>$req->get('description'),
            'attachment'=>'attachment',
            'status_id'=>22,
            'project_id'=>$id,
            'user_id'=>$payload->userid->id
            // 'user_id'=>7
        ])->save();
    }

    public function showTask($project_id,$task_id){
        $task=Task::find($task_id);
        // echo $task;
        $users=$task->users;
        // echo $users;
        $status=$task->status_id;
        // $status=$status->type;
        $status=Status::find($status);
        $status=$status->type;
        // echo $status;
        return response()->json([
            "task"=>$task,
            "project_id"=>$project_id,
            "taskstatus"=>$status,
            "status"=>200
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
        $res=$task->save();
        if($res){
            return true;
        }
    }

    public function deleteTask($task_id){
        $task=Task::find($task_id);
        $statusId=$task->status_id;
        $projectId=$task->project_id;
        $task->delete();
        $numberOfTask=Task::where('status_id',$statusId)->where('project_id',$projectId)->get();
        // echo $numberOfTask;
        if(count($numberOfTask)==0){
            return $statusId;
        }
    }

    public function getStatuses($project_id,$task_id){
        $status_ids= Project::find($project_id);
        $status_ids=$status_ids->status;
        return $status_ids;

    }

    public function searchTask($req,$id){
        $query=$req->get('search-input');
        // dd($query);
        if($query==null){
        $status_ids= Status::where('project_id',$id)->get();
        foreach($status_ids as &$s){
            $s->tasks=Task::where('status_id',$s->id)->where('project_id',$id)->get();
        }
        return response()->json([
            "result"=>$status_ids,
            "status"=>200
        ]);
        }
        else{
        $status_ids= Status::where('project_id',$id)->get();
        foreach($status_ids as &$s){
            $s->tasks=Task::where(function ($q)use($s,$id){$q->where('status_id',$s->id)->where('project_id',$id);})->where(function ($q)use($query){$q->where('title', 'LIKE', "%{$query}%")->orWhere('description', 'LIKE', "%{$query}%");})->get();
        }
        return response()->json([
            "result"=>$status_ids,
            "status"=>200
        ]);
        }
    }

}
