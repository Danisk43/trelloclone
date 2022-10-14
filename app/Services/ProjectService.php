<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use Validator;


class ProjectService
{
    function showAllProjects(){
        return Project::all();
    }

    function addProject($req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $project = new Project;
        $project->name=$req->name;
        $project->owner_id=$req->owner_id;
        $project->save();
    }

    function showProject($id){
        return Project::find($id);
    }

    function updateProject($req,$id){
        $project=Project::find($id);
        $project->name=$req->name;
        $project->save();
    }
}
