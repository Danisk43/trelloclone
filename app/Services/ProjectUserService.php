<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\ProjectUser;
use App\Models\Project;
use Validator;
use Illuminate\Support\Facades\Session;


class ProjectUserService
{
    public function showUsers($id){
        return Project::find($id)->users();
    }

    public function addUser($req,$id){
        // $user = new ProjectUser;
        // $user->project_id=$id;
        // $user->user_id=$req->user_id;
        // $user->save();

        return $res = (new ProjectUser())->fill([
            'project_id'=>$id,
            'user_id'=>$req->get('user_id'),
        ])->save();
    }

    public function deleteUser($project_id,$user_id){
        $user=ProjectUser::where('project_id',$project_id)->where('user_id',$user_id);
        $user->delete();
    }
}