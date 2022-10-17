<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use Validator;


class ProjectService
{
    public function showAllProjects(){
        return User::find(Session::get('user_id'))->projects();
    }

    public function addProject($req)
    {
        // $project = new Project;
        // $project->name=$req->name;
        // $project->owner_id=$req->owner_id;
        // $project->save();

        return $res = (new Project())->fill([
            'name'=>$req->get('name'),
            'owner_id'=>Session::get('user_id'),
        ])->save();
    }

    public function showProject($id){
        return Project::find($id);
    }

    public function updateProject($req,$id){
        // $project=Project::find($id);
        // $project->name=$req->name;
        // $project->save();

        return $res = Project::find($id)->fill([
            'name'=>$req->get('name'),
        ])->save();
    }
}
