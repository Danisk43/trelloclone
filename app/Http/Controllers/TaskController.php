<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use App\Services\TaskService;
use Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Attachment;



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

        $status=Status::where('project_id',$id)->where('type','OPEN')->get('id')->first();
        // echo $status->id;
        $res=Task::create([
            'title'=>$req->get('title'),
            'description'=>$req->get('description'),
            'attachment'=>'attachment',
            'status_id'=>$status->id,
            'project_id'=>$id,
            // 'user_id'=>$user_id
            'user_id'=>$req->payload->userid->id
        ]);

            return response()->json([
                "status"=>200,
                "title"=>$req->get('title'),
                "description"=>$req->get('description'),
                "id"=>$res->id,
                "project_id"=>$id,
                "status_id"=>$status->id
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

    public function getStatuses($project_id){
        $statusIds=TaskService::getStatuses($project_id);
        return response()->json([
            "statusIds"=>$statusIds
        ]);
    }

    public function searchTask(Request $req,$id){
        return TaskService::searchTask($req,$id);
    }

    // public function fileUpload(Request $req,$id){

    //     $fileName = time().'.'.$req->file->extension();
    //     $req->file->move(public_path('uploads'), $fileName);
    //     $task=Task::find($id);
    //     $task->attachment=$fileName;
    //     $task->save();
    //     return response()->json([
    //         "status"=>200,
    //         "filename"=>$fileName,
    //     ]);
    //     // dd($task);
    // }

    public function fileUpload(Request $req,$id){
        // dd($req->files);

        foreach($req->files as $key => $file)
            {
                // dd($file);
                $res=array();
                $i=0;
                foreach($file as $f){
                // echo($f);
                $fileName = time().'.'.rand(1,100).'.'.$f->getClientOriginalExtension();
                $f->move(public_path('uploads'), $fileName);
                $path=Attachment::create([
                    'path'=>$fileName,
                    'user_id'=>$req->payload->userid->id,
                    'task_id'=>$id
                ]);
                $res[$i]=$path;

                $i++;
                }
            }
        return response()->json([
            "status"=>200,
            "filename"=>$res,
            "username"=>$req->payload->userid->first_name
        ]);
    }

    public function fileDownload($task_id,$id){
        $file_name=Attachment::find($id)->path;
        // dd($file_name);
        return response()->download('uploads/'.$file_name);
    }

    public function filterTask(Request $req,$id){
        // dd($req);
        $filter=$req->statusIds;
        $filter=json_decode($filter[0]);
        $status_ids= Status::where('project_id',$id)->where(function($q)use($filter){$q->where('id',$filter[0]);for($f=1;$f<count($filter);$f++){$q->orWhere('id',$filter[$f]);}})->get();
        // dd($status_ids);
        foreach($status_ids as &$s){
            $s->tasks=Task::where('status_id',$s->id)->where('project_id',$id)->get();
        }
        return response()->json([
            "status"=>200,
            "result"=>$status_ids
        ]);
    }

    public function showMoreTasks($project_id,$status_id,$offset){
        $result=TaskService::showMoreTasks($project_id,$status_id,$offset);
        return response()->json([
            "status"=>200,
            "result"=>$result
        ]);
    }


}
