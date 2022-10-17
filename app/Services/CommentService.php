<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Comment;
use Validator;


class CommentService
{
    public function showComments(){
        return Comment::task();
    }
    public function addComment($req,$task_id)
    {
        // $project = new Comment;
        // $project->description=$req->description;
        // $project->user_id=$req->user_id;
        // $project->task_id=$req->task_id;
        // $project->save();

        return $res = (new Comment())->fill([
            'description'=>$req->get('description'),
            'user_id'=>Session::get('user_id'),
            'task_id'=>$task_id,
        ])->save();
    }
}
