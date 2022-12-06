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
            "status"=>200
        ]);
    }
}
