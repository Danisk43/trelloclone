<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Comment;
use Validator;


class CommentService
{
    function showComments(){
        return Comment::all();
    }
    function addComment($req)
    {
        $validator = Validator::make($req->all(), [
            'description' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $project = new Comment;
        $project->description=$req->description;
        $project->user_id=$req->user_id;
        $project->task_id=$req->task_id;
        $project->save();
    }
}
