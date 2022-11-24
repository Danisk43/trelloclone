<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\user;
use Illuminate\Support\Facades\Session;
use App\Services\CommentService;
use Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;



class CommentController extends Controller
{
    public function showComments($id){
       return CommentService::showComments($id); 
    }
    public function addComment(Request $req,$task_id)
    {
        $validator = Validator::make($req->all(), [
            'description' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $token = $req->header('token');
        $payload=JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256'));
        // dd($payload->userid->id);
        $res=Comment::create([
            'description'=>$req->get('description'),
            'user_id'=>$payload->userid->id,
            'task_id'=>$task_id
        ]);
        // $res=$res->id;
        $username=User::find($payload->userid->id);
        // $username=User::find();
        $username=$username->first_name;

        return response()->json([
            "status"=>200,
            "username"=>$username,
            "time"=>$res->created_at
        ]);
    }
}
