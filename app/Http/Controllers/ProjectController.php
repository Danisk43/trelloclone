<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Services\ProjectService;
use Validator;


class ProjectController extends Controller
{
    //
   public function showAllProjects(Request $req){
        return ProjectService::showAllProjects($req);
    }

    public function addProject(Request $req)
    {
        // dd($req);
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
       ProjectService::addProject($req);
       $id=Project::where('name',$req->get('name'))->first();
       return response()->json([
        "status"=>200,
        "message"=>"Project created successfully",
        "id"=>$id->id,
        "name"=>$id->name,
       ]);
    }

    public function showProject($id){
        return ProjectService::showProject($id);
    }

    public function updateProject(Request $req,$id){
        if(ProjectService::updateProject($req,$id)){

            return response()->json([
                "status"=>200,
                "message"=>"Project updated successfully"
            ]);
        }
    }

    public function deleteProject($id){
        if(ProjectService::deleteProject($id)){
            return response()->json([
                "status"=>200,
                "message"=>"Project deleted successfully",
            ]);
        }
    }
}
