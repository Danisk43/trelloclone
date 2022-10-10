<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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
    Route::get('/', function () {
        return view('welcome');
    });
    Route::post('/', function () {
        return view('welcome');
    });
    
    
    
    Route::get('/{id}', function () {
        return view('welcome');
    });
    Route::patch('/{id}', function () {
        return view('welcome');
    });
    
    
    
    Route::get('/{id}/task', function () {
        return view('welcome');
    });
    Route::post('/{id}/task', function () {
        return view('welcome');
    });
    
    
    
    Route::get('/{id}/task/{id}', function () {
        return view('welcome');
    });
    Route::patch('/{id}/task/{id}', function () {
        return view('welcome');
    });
    Route::delete('/{id}/task/{id}', function () {
        return view('welcome');
    });
    
    
    
    Route::get('/id/user', function () {
        return view('welcome');
    });
    Route::post('/id/user', function () {
        return view('welcome');
    });
    Route::delete('/id/user', function () {
        return view('welcome');
    });
    
    
    
    Route::get('/id/task/id/comment', function () {
        return view('welcome');
    });
    
    Route::post('/id/task/id/comment', function () {
        return view('welcome');
    });
    
});













