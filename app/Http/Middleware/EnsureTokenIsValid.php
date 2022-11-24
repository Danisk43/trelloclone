<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('token');
        // dd($token);
        $payload=JWT::decode($token,new Key(env('JWT_SECRET'), 'HS256'));
        if($payload){
        return $next($request);
        }
        else{
            response()->json([
                "status"=>498,
                "error"=>"Token is Invalid"
            ]);
        }
    
    }
}
