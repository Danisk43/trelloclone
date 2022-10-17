<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Services\ProjectService;
use Validator;


class ProjectController extends Controller
{
    //
   public function showAllProjects(){
        return ProjectService::showAllProjects();
    }

    public function addProject(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
       return ProjectService::addProject($req);
    }

    public function showProject($id){
        return ProjectService::showProject($id);
    }

    public function updateProject(Request $req,$id){
        ProjectService::updateProject($req,$id);
    }
}
