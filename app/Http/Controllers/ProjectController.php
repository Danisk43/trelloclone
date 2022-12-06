<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Validator;



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
        return response()->json([
            "status"=>400,
            "message"=>$validator->messages()
        ]);
    }
        $checkIfNameExists=Project::where('name',$req->get('name'))->first();
        // dd($checkIfNameExists);
        if($checkIfNameExists!=null){
            return response()->json([
                "status"=>403,
                "message"=>"A Project with this name already exists, please assign a different name"
            ]);
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
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:20',
        ]);
        if ($validator->fails()) {
            // dd($validator->messages());
            // return redirect('dashboard')->withErrors($validator);
            return response()->json([
                "status"=>400,
                "message"=>$validator->messages()
            ]);
        }
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

    public function shareProject(Request $req, $id){
        $validator=Validator::make($req->all(),[
            'email'=>'required|email|exists:users',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status"=>400,
                "message"=>$validator->messages()
            ]);
        }
        ProjectService::shareProject($req,$id);
            return response()->json([
                "status"=>200,
                "message"=>"Project shared successfully"
            ]);

    }
}
