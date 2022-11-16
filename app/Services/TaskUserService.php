<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\TaskUser;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

use Validator;
use Illuminate\Support\Facades\Session;


class TaskUserService
{
    public function showUsers($id){
        $task = Task::find($id);
        $project=Project::find($task->project->id);
        $existingUsers=TaskUser::where('task_id',$id)->get();
        $allUsers=$project->users;
        // echo $allUsers;
        $allUsersId=array();
        foreach($allUsers as $a){
            array_push($allUsersId,$a->id);
        }
        // print_r($allUsersId);
        $existingUsersId=array();
        foreach($existingUsers as $e){
            array_push($existingUsersId,$e->user_id);
        }
        // print_r($existingUsersId);
        $availableUsersId=array_diff($allUsersId,$existingUsersId);
        // print_r($availableUsersId);
        $availableUsers=array();
        // foreach($availableUsersId as $a){
        //     echo User::find($a)->get();
        //     array_push($availableUsers,User::find($a)->get());
        // }
        for ($i = 0; $i < count($allUsersId); $i++) {
            // echo User::find($availableUsersId[$i]);
            if(array_key_exists($i,$availableUsersId)){
            array_push($availableUsers,User::find($availableUsersId[$i]));
        }
    }
        // print_r($availableUsers);
        return $availableUsers;
        // return $project->users;
    }

    public function addUser($task_id,$user_id){
        return $res = (new TaskUser())->fill([
            'task_id'=>$task_id,
            'user_id'=>$user_id,
        ])->save();

        
    }

    public function removeUser($task_id,$user_id){
        $user=TaskUser::where('task_id',$task_id)->where('user_id',$user_id);

        $res=$user->delete();
        if($res){
            return true;
        }
        else{
            return false;
        }
    }

}