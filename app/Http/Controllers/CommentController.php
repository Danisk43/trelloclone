<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Services\CommentService;


class CommentController extends Controller
{
    function showComments(){
        return CommentService::showComments();
    }
    function addComment(Request $req)
    {
        return CommentService::addComment($req);
    }
}
