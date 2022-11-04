<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;
use DB; 
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon; 




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
            $data = [
                'name' => $req->get('first_name'),
                'email' => $req->get('email'),
                'id' => $res->id
            ];
            $mail=Mail::to($req->get('email'))->send(new RegisterMail($data));
            return true;
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
            Session::put("user_id",Auth::user()->id);
            return true;
        }
  
        return false;
    }

    public function forgotPassword($req){
        // $res=User::where('email',$req->get('email'))->get()->first();
        // if($res!=null){
        //     $data=[
        //         'email'=>$req->get('email')
        //     ];
        //     Mail::to($req->get('email'))->send(new ResetPasswordMail($data));
        // }

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $req->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
        $email = $req->email;
        Mail::send('reset-password-mail', ['token' => $token], function($message) use($req){
            $message->to($req->email);
            $message->subject('Reset Password');
        });
        return true;
    }

    public function changePassword($request){
        // return $res = User::where('email',$req->get('email'))->first()->fill([
        //     'password'=>$req->get('password'),
        // ])->save();
        // dd($request);
         
        // dd($request);
        $updatePassword = DB::table('password_resets')
                            ->where([
                              'token' => $request->token
                            ])
                            ->first();
        if(!$updatePassword){
            
        }
        $email=$updatePassword->email;
        $user = User::where('email', $email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $email])->delete();
        return true;
    }
    
}