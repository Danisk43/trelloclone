<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectUserService;


class ProjectUserController extends Controller
{
    function showUsers($id){
        return ProjectUserService::showUsers($id);
    }

    function addUser(Request $req,$id){
        return ProjectUserService::addUser($req,$id);
    }

    function deleteUser($project_id,$user_id){
        return ProjectUserService::deleteUser($project_id,$user_id);
    }
}
