<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Services\ProjectService;



class ProjectController extends Controller
{
    //
    function showAllProjects(){
        return ProjectService::showAllProjects();
    }

    function addProject(Request $req)
    {
       return ProjectService::addProject($req);
    }

    function showProject($id){
        return ProjectService::showProject($id);
    }

    function updateProject(Request $req,$id){
        ProjectService::updateProject($req,$id);
    }
}
