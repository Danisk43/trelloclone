<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectUserController;





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



Route::post('login', function () {
    return view('welcome');
});
Route::post('/register', function () {
    return view('welcome');
});



Route::prefix('project')->group(function () {
    Route::get('/',[ProjectController::class,'showAllProjects']);
    Route::post('/',[ProjectController::class,'addProject']);
    
    
    
    Route::get('/{projectId}',[ProjectController::class,'showProject']);
    Route::patch('/{projectId}',[ProjectController::class,'updateProject']);
    
    
    
    Route::get('/{projectId}/task',[TaskController::class,'showAllTasks']);
    Route::post('/{projectId}/task',[TaskController::class,'addTask']);
    
    
    
    Route::get('/{projectId}/task/{taskId}', [TaskController::class,'showTask']);
    Route::patch('/{projectId}/task/{taskId}',[TaskController::class,'updateTask']);
    Route::delete('/{projectId}/task/{taskId}',[TaskController::class,'deleteTask']);
    
    
    
    Route::get('/{projectId}/user',[ProjectUserController::class,'showUsers']);
    Route::post('/{projectId}/user',[ProjectUserController::class,'addUser']);
    Route::delete('/{projectId}/user/{userId}',[ProjectUserController::class,'deleteUser']);
    
    
    
    Route::get('/{projectId}/task/{taskId}/comment', [CommentController::class,'showComments']);
    Route::post('/{projectId}/task/{taskId}/comment',[CommentController::class,'addComment']);
    
});
