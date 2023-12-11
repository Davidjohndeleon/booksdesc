<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

//makes an authentication for bearer tokens using login
    public function login(Request $request){
        if(Auth::attempt([
            "email"=>$request->email,
            "password"=>$request->password
        ])){
            //creates token per log in
            $user = Auth::user();
            $token = $user->createToken($user->email)->plainTextToken;
            return response([
                "message"=>"log in success!",
                "token"=>$token
            ]);
            //show this when log in is invalid
        }else{
            return response(["message"=>"Invalid username or password"],401);
        }
    }
}
