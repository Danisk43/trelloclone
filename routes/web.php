<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/                  
Route::get('/',function(){
    return view('welcome');
});

Route::get('/register',[AuthController::class,'registerView']);
Route::get('/login',[AuthController::class,'loginView']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::post('/forgot-password',[AuthController::class,'forgotPassword']);
Route::post('/change-password',[AuthController::class,'changePassword']);

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/set-token',[AuthController::class,'setToken']);


Route::get('forgot-password',[AuthController::class,'forgotPasswordView']);
Route::get('change-password/{token}',[AuthController::class,'changePasswordView'])->name('changePassword');


Route::get('/verify',[AuthController::class,'verify']);

Route::get('/dashboard',[AuthController::class,'dashboardView']);



