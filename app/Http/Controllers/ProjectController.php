<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ProjectController extends Controller
{
    //
   public function showAllProjects(Request $req){
        return ProjectService::showAllProjects($req);
    }

    public function addProject(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => ['required','max:20',Rule::unique('projects')->where(function ($query) use($req){return $query->where('owner_id', $req->payload->userid->id);})]
        ]);
        if ($validator->fails()) {
        return response()->json([
            "status"=>400,
            "message"=>$validator->messages()
        ]);
    }
        // $checkIfNameExists=Project::where('name',$req->get('name'))->first();
        // // dd($checkIfNameExists);
        // if($checkIfNameExists!=null){
        //     return response()->json([
        //         "status"=>403,
        //         "message"=>"A Project with this name already exists, please assign a different name"
        //     ]);
        // }
       $response = ProjectService::addProject($req);
    //    echo $response;
       return response()->json([
        "status"=>200,
        "message"=>"Project created successfully",
        "id"=>$response['id'],
        "name"=>$response['name'],
       ]);
    }

    public function showProject($id){
        return ProjectService::showProject($id);
    }

    public function updateProject(Request $req,$id){
        $validator = Validator::make($req->all(), [
            'name' => ['required','max:20',Rule::unique('projects')->where(function ($query) use($req){return $query->where('owner_id', $req->payload->userid->id);})]
        ]);
        if ($validator->fails()) {
            // dd($validator->messages());
            // return redirect('dashboard')->withErrors($validator);
            return response()->json([
                "status"=>400,
                "message"=>$validator->messages()
            ]);
        }
        ProjectService::updateProject($req,$id);

            return response()->json([
                "status"=>200,
                "message"=>"Project updated successfully"
            ]);

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
