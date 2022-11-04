<?php

namespace App\Http\Controllers;

use App\Services\TaskUserService;
use Illuminate\Http\Request;

class TaskUserController extends Controller
{
    public function removeUser($task_id,$user_id){
        TaskUserService::removeUser($task_id,$user_id);
        return response()->json([
            "status"=>200,
        ]);
    }

    public function addUser($task_id,$user_id){
        TaskUserService::addUser($task_id,$user_id);
        return response()->json([
            "status"=>200,
        ]);
    }

    public function showUsers($id){
        $users= TaskUserService::showUsers($id);
        return response()->json([
            "status"=>200,
            "users"=>$users
        ]);
    }
}
