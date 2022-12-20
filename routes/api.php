<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\TaskUserController;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\GetUser;







/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list',[DemoController::class,'show']);


Route::get('/',function(){
    $users=User::all();
    echo "<pre>";
    print_r($users);
});

Route::post('/verify-token/{token}',[AuthController::class,'verifyToken']);



Route::prefix('project')->group(function () {


    Route::get('/',[ProjectController::class,'showAllProjects'])->middleware(GetUser::class);
    Route::post('/',[ProjectController::class,'addProject'])->middleware(GetUser::class);

    Route::get('/{projectId}',[ProjectController::class,'showProject']);
    Route::patch('/{projectId}',[ProjectController::class,'updateProject']);
    Route::delete('/{projectId}',[ProjectController::class,'deleteProject']);

    Route::post('/{projectId}/share',[ProjectController::class,'shareProject']);


    Route::post('/{projectId}/tasks',[TaskController::class,'showAllTasks']);
    Route::post('/{projectId}/tasks-with-status',[TaskController::class,'showAllTasksWithStatus']);


    Route::get('/{projectId}/task/{taskId}', [TaskController::class,'showTask']);
    Route::post('/{projectId}/task',[TaskController::class,'addTask'])->middleware(GetUser::class);
    Route::patch('/{projectId}/task/{taskId}',[TaskController::class,'updateTask']);
    Route::delete('/task/{taskId}',[TaskController::class,'deleteTask']);



    Route::get('/task/{taskId}/user',[TaskUserController::class,'showUsers']);
    Route::get('/task/{taskId}/user/{userId}',[TaskUserController::class,'addUser']);
    Route::delete('task/{taskId}/user/{userId}',[TaskUserController::class,'removeUser']);



    Route::get('/task/{taskId}/comment', [CommentController::class,'showComments']);
    Route::post('/task/{taskId}/comment',[CommentController::class,'addComment'])->middleware(GetUser::class);

    Route::get('/{projectId}/status',[TaskController::class,'getStatuses']);

    Route::post('/{projectId}/task/search',[TaskController::class,'searchTask']);

    Route::post('/task/{taskId}/upload-file', [TaskController::class, 'fileUpload'])->middleware(GetUser::class);

    Route::post('/{projectId}/filter',[TaskController::class,'filterTask']);

    Route::get('/{projectId}/{statusId}/{offset}/show-more-tasks',[TaskController::class,'showMoreTasks']);

});
