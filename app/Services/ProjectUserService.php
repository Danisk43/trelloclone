<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\ProjectUser;
use Validator;

class ProjectUserService
{
    function showUsers($id){
        return ProjectUser::all()->where('project_id',$id);
    }

    function addUser($req,$id){
        $user = new ProjectUser;
        $user->project_id=$id;
        $user->user_id=$req->user_id;
        $user->save();
    }

    function deleteUser($project_id,$user_id){
        $user=ProjectUser::where('project_id',$project_id)->where('user_id',$user_id);
        $user->delete();
    }
}