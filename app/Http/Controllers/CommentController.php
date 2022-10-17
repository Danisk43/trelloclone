<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Services\CommentService;
use Validator;



class CommentController extends Controller
{
    public function showComments(){
        return CommentService::showComments();
    }
    public function addComment(Request $req,$project_id,$task_id)
    {
        $validator = Validator::make($req->all(), [
            'description' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        return CommentService::addComment($req,$task_id);
    }
}
