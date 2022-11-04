<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectUserService;


class ProjectUserController extends Controller
{
   

    

    public function deleteUser($project_id,$user_id){
        return ProjectUserService::deleteUser($project_id,$user_id);
    }
}
