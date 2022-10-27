<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Session;


class ProjectService
{
    public function showAllProjects(){
            // dd(session()->all());
        // return User::find(Session::get('user_id'))->projects();
        // dd( User::find(1)->projects());
        // $project=[User::class,'projects'];
        // dd($project);
        $projects = User::find(7);	
        // $projects=$projects->projects->pluck('name');
        $projects=$projects->projects;

        return response()->json([
            "projects"=>$projects,
        ]);
    }

    public function addProject($req)
    {
        $res = (new Project())->fill([
            'name'=>$req->get('name'),
            // 'owner_id'=>Session::get('user_id'),
            'owner_id'=>'1',
        ])->save();
    }

    public function showProject($id){
        // return Project::find($id);
       
    }

    public function updateProject($req,$id){
        // $project=Project::find($id);
        // $project->name=$req->name;
        // $project->save();

        return $res = Project::find($id)->fill([
            'name'=>$req->get('name'),
        ])->save();
    }

    public function deleteProject($id){
        Project::find($id)->delete();
    }
}
