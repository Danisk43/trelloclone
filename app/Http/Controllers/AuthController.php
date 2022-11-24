<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;




class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','loginView','dashboardView','register','logout']]);
    // }

    public function register(Request $req){
        // echo $req;
        // print_r($req->all());
        $validator = Validator::make($req->all(),[
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|max:50|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'

        ]);
        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect('register')->withErrors($validator);
        }
        
        if(AuthService::register($req)){
            return redirect('register')->withSuccess('Your account has been created. Please check email for verification link.');
        }
        else{
            return redirect()->back()->withFailure("Something went wrong!");
        }

    }

    

    public function login(Request $req){
        // echo $req;
        $validator = Validator::make($req->all(),[
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect('login')->withErrors($validator);
        }

        if(AuthService::login($req)){
            $token=$this->setToken();
            // dd(JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256')));
            return redirect("/dashboard");
        }
        else{
            return redirect("login")->withFailure('Login details are not valid');
        }

    }


    public function forgotPassword(Request $req){
            $req->validate([
                'email' => 'required|email|exists:users'
            ]);
            if(AuthService::forgotPassword($req)){
            return redirect('forgot-password')->withSuccess('Your request has been accepted. Please check email to change password.');
            }
            else{
                return redirect("forgot-password")->withFailure('Something went wrong!');
            }

    }

    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
       if(AuthService::changePassword($request)){
        return redirect("login")->withSuccess('Password changed successfully, please log in here!');
       }
       else{
        return back()->withFailure('Invalid token!');
       }
    }


    public function registerView(){
        return view("register");
    }

    public function loginView(){
        return view("login");
    }

    public function forgotPasswordView(){
        return view("forgot-password");
    }

    public function changePasswordView($token){
        return view("change-password",['token'=>$token]);
    }


    public function verify(Request $req){
        $user=User::where('id',$req->get('id'))->first();
        $user->is_verified=1;
        $user->save();
        return redirect('login')->withSuccess('Email has been verified, please login here');
    }

    public function logout(){
        // Auth::logout();
        session()->flush();
        return redirect('login');
    }

    public function dashboardView(){
        if(Auth::check()){
            return view('project-dashboard/project');
        }
        return redirect("login")->withSuccess('Please login first');
    }

    public function setToken(){
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;
        $user=Auth::user();
        // dd($user);
        $payload = array(
        'userid' => $user,
        'iat' => $issuedAt,
        'exp' => $expirationTime
        );
        // dd($payload);
        $key = env('JWT_SECRET');
        $alg = 'HS256';
        $jwt = JWT::encode($payload, $key, $alg);
        // return $jwt;
        return response()->json([
            "status"=>200,
            "jwt"=>$jwt,
            "user"=>$user
        ]);
    }

    public function verifyToken($token){
        $payload=JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256'));
        // dd($payload);
        if($payload->exp<time()){
        return redirect("login")->withFailure('Timeout! Please login again');
        }
        return response()->json([
            "status"=>200,
            "payload"=>$payload
        ]);
    }

}
