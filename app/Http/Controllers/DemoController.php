<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Status;
use App\Models\ProjectUser;
use App\Models\TaskUser;


class DemoController extends Controller
{
    //
    function show(){
        return User::all();
    }
    
}
