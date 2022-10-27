<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;



class AuthController extends Controller
{
    public function register(Request $req){
        // echo $req;
        print_r($req->all());
        $validator = Validator::make($req->all(), [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|max:50',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        return AuthService::register($req);
        return redirect()->back()->withSuccess('Something went wrong!');

    }

    
    
    public function login(Request $req){
        // echo $req;
        $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(AuthService::login($req)){
            return redirect()->intended('/')
                        ->withSuccess('Signed in');
        }
        else{
            echo "error";
            return redirect("login")->withSuccess('Login details are not valid');
        }

    }

   



    public function registerView(){
        return view("register");
    }

    public function loginView(){
        return view("login");
    }

    public function verify(Request $req){
        $user=User::where('id',$req->get('id'))->first();
        $user->is_verified=1;
        $user->save();
        return redirect('login')->withSuccess('Email has been verified, please login here');
    }


}
