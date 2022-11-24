<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;

use Validator;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class ProjectService
{
    public function showAllProjects($req){

        $token = $req->header('token');
        $payload=JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256'));
        // dd($payload);
        $projects = User::find($payload->userid->id);

        // $projects=$projects->projects->pluck('name');
        $projects=$projects->projects;
        // dd($projects);

        return response()->json([
            "projects"=>$projects,
        ]);
    }

    public function addProject($req)
    {
        // $user_id=Session::get('user_id');
        $token = $req->header('token');
        $payload=JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256'));
        $res = (new Project())->fill([
            'name'=>$req->get('name'),
            'owner_id'=>$payload->userid->id,
            // 'owner_id'=>'1',
        ])->save();
        $project_id=Project::where('name',$req->get('name'))->first();
        // echo $project_id;
        $new=(new ProjectUser())->fill([
            'project_id'=>$project_id->id,
            // 'user_id'=>'1'
            'user_id'=>$payload->userid->id,
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
