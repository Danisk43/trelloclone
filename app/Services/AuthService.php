<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;




class AuthService
{
    public function register($req){
        $res = (new User())->fill([
            'first_name'=>$req->get('first_name'),
            'last_name'=>$req->get('last_name'),
            'email'=>$req->get('email'),
            'password'=>bcrypt($req->get('password')),
        ])->save();
        $res=User::where('email',$req->get('email'))->get()->first();
        // dd($res->id);
        
        if($res != null){
            $data = [
                'name' => $req->get('first_name'),
                'email' => $req->get('email'),
                'id' => $res->id
            ];
            Mail::to($req->get('email'))->send(new RegisterMail($data));
            return redirect('register')->withSuccess('Your account has been created. Please check email for verification link.');
        }

    }

    // public function login(LoginRequest $request)
    // {
    //     $request->authenticate();

    //     return $request->session()->regenerate();

    // }

    // public function login($credentials){
    //     if(Auth::attempt($credentials)){

    //         $user = User::where('email',$credentials['email'])->first();
    //         // echo $user->id;
    //         $credentials->session()->regenerate();
    //         Session::put("user_id",1);
    //         Session::save();
    //         // dd(session()->all(),$user->id);
    //         // return redirect()->intended("/");
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    public function login($req){
        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return true;
        }
  
        return false;
    }

    
}