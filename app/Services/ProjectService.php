<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;
use App\Models\Status;


use Validator;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class ProjectService
{
    public function showAllProjects($req){

        $projects = User::find($req->payload->userid->id);

        // $projects=$projects->projects->pluck('name');
        $projects=$projects->projects;
        // echo($projects);

        return response()->json([
            "projects"=>$projects,
            "status"=>200
        ]);
    }

    public function addProject($req)
    {
        // $user_id=Session::get('user_id');

        $res = (new Project())->fill([
            'name'=>$req->get('name'),
            'owner_id'=>$req->payload->userid->id,
            // 'owner_id'=>'1',
        ])->save();
        $project_id=Project::where('name',$req->get('name'))->where('owner_id',$req->payload->userid->id)->first();
        // echo $project_id;
        $new=(new ProjectUser())->fill([
            'project_id'=>$project_id->id,
            // 'user_id'=>'1'
            'user_id'=>$req->payload->userid->id,
        ])->save();
        $status1=Status::create([
            'project_id'=>$project_id->id,
            'type'=>"OPEN"
        ]);
        $status2=Status::create([
            'project_id'=>$project_id->id,
            'type'=>"CLOSE"
        ]);
        return (['id'=>$project_id->id,'name'=>$project_id->name]);
    }

    public function showProject($id){
        // return Project::find($id);

    }

    public function updateProject($req,$id){
        // $project=Project::find($id);
        // $project->name=$req->name;
        // $project->save();

        $res = Project::find($id)->fill([
            'name'=>$req->get('name'),
        ])->save();

        if($req->get('custom-status')!=""){
            $status=Status::create([
                'project_id'=>$id,
                "type"=>$req->get('custom-status')
            ]);
        }


    }

    public function deleteProject($id){
        if(Project::find($id)->delete()){
            return true;
        }
        else{
            return false;
        }

    }

    public function shareProject($req,$id){
        $user_id=User::where('email',$req->get('email'))->first()->id;
        // echo $user_id;
        $new=(new ProjectUser())->fill([
            'project_id'=>$id,
            // 'user_id'=>'1'
            'user_id'=>$user_id,
        ])->save();
    }
}
