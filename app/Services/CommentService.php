<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Session;



class CommentService
{
    public function showComments($id){        
        $comments=Comment::where('task_id',$id)->get();
        // $temp = json_decode($comments);
        foreach($comments as &$c){
            $user=User::find($c->user_id)->first_name;
            $c->first_name=$user;
            // echo $user;
        }
        // echo $comments;
        // $comments = json_encode($temp);
        return response()->json([
            "comments"=>$comments,
        ]);
    }
    public function addComment($req,$task_id)
    {
        // $project = new Comment;
        // $project->description=$req->description;
        // $project->user_id=$req->user_id;
        // $project->task_id=$req->task_id;
        // $project->save();

         $res = (new Comment())->fill([
            'description'=>$req->get('description'),
            // 'user_id'=>Session::get('user_id'),
            'task_id'=>$task_id,
            'user_id'=>'6',
            ])->save();
    }
}
