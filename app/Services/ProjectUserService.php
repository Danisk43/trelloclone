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

    

    public function deleteUser($task_id,$user_id){
        $user=TaskUser::where('task_id',$task_id)->where('user_id',$user_id);
        $user->delete();
    }
}