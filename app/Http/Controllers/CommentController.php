<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Services\CommentService;
use Validator;



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
        CommentService::addComment($req,$task_id);
        
        return response()->json([
            "status"=>200,
            "message"=>"Comment added successfully"
        ]);
    }
}
