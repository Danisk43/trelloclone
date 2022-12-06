<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use App\Services\TaskService;
use Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class TaskController extends Controller
{
    public function showAllTasks(Request $id){
        return TaskService::showAllTasks($id);
    }

    public function showAllTasksWithStatus($id){
        return TaskService::showAllTasksWithStatus($id);
    }

    public function addTask(Request $req,$id)
    {
        $validator = Validator::make($req->all(), [
            'title' => 'required|max:20',
            'description' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status"=>400,
                "message"=>$validator->messages()
            ]);
        }
        // $user_id = Session::get('user_id');
        $token = $req->header('token');
        $payload=JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256'));
        $res=Task::create([
            'title'=>$req->get('title'),
            'description'=>$req->get('description'),
            'attachment'=>'attachment',
            'status_id'=>22,
            'project_id'=>$id,
            // 'user_id'=>$user_id
            'user_id'=>$payload->userid->id
        ]);
            return response()->json([
                "status"=>200,
                "title"=>$req->get('title'),
                "description"=>$req->get('description'),
                "id"=>$res->id,
                "project_id"=>$id
            ]);

    }

    public function showTask($project_id,$task_id){
        return TaskService::showTask($project_id,$task_id);
    }

    public function updateTask(Request $req,$project_id,$task_id){
        $validator = Validator::make($req->all(), [
            'title' => 'required|max:20',
            'description' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status"=>400,
                "message"=>$validator->messages()
            ]);
        }
        $task=Task::find($task_id);
        $prev_status=$task->status_id;
        $numberOfTaskOnPrevStatus=Task::where('status_id',$prev_status)->where('project_id',$project_id)->get();
        if(count($numberOfTaskOnPrevStatus)==1){
            $deletePrevStatus=true;
        }
        else{
            $deletePrevStatus=false;
        }
        if(TaskService::updateTask($req,$project_id,$task_id)){

            $task=Task::find($task_id);
            $statusId=$task->status_id;
            $status=Status::find($statusId);
            $statusType=$status->type;
            $numberOfTask=Task::where('status_id',$statusId)->where('project_id',$project_id)->get();
            if(count($numberOfTask)>1){
                return response()->json([
                    "status"=>200,
                    "task"=>$task,
                    "status_type"=>$statusType,
                    "status_id"=>$statusId,
                    "prev_status"=>$prev_status,
                    "new_status"=>false,
                    "delete_prev_status"=>$deletePrevStatus,
                    // "test"=>$numberOfTask
                    // "project_id"=>$project_id
                ]);
            }
            return response()->json([
                "status"=>200,
                "task"=>$task,
                "status_type"=>$statusType,
                "status_id"=>$statusId,
                "prev_status"=>$prev_status,
                "new_status"=>true,
                "delete_prev_status"=>$deletePrevStatus,
                // "test"=>$numberOfTask
                // "project_id"=>$project_id
            ]);
        }
    }

    public function deleteTask($task_id){
        $statusId=TaskService::deleteTask($task_id);
        return response()->json([
            "status"=>200,
            "message"=>"Project deleted successfully",
            "statusId"=>$statusId
        ]);
    }

    public function getStatuses($project_id,$task_id){
        $statusIds=TaskService::getStatuses($project_id,$task_id);
        return response()->json([
            "statusIds"=>$statusIds
        ]);
    }

    public function searchTask(Request $req,$id){
        return TaskService::searchTask($req,$id);
    }

}
