<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;

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
        // $projects = User::find();
        // dd(session()->all());
        $projects = User::find(Session::get('user_id'));

        // $projects=$projects->projects->pluck('name');
        $projects=$projects->projects;
        // dd($projects);

        return response()->json([
            "projects"=>$projects,
        ]);
    }

    public function addProject($req)
    {
        // dd(Session::all());
        $user_id=Session::get('user_id');
        $res = (new Project())->fill([
            'name'=>$req->get('name'),
            'owner_id'=>$user_id,
            // 'owner_id'=>'1',
        ])->save();
        $project_id=Project::where('name',$req->get('name'))->first();
        // echo $project_id;
        $new=(new ProjectUser())->fill([
            'project_id'=>$project_id->id,
            // 'user_id'=>'1'
            'user_id'=>$user_id,
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
        if(Project::find($id)->delete()){
            return true;
        }
        else{
            return false;
        }

    }
}
