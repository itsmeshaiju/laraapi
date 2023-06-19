<?php

namespace App\Http\Controllers;


use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //
    public function register(Request $request){
        $fields= $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|confirmed'
        ]);

        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $resonse = [
            'user'=>$user,
            'token'=>$token
        ];
        return response($resonse,201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=>'logged out'
        ];

    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        //check email
        $user = User::Where('email',$fields['email'])->first();
       // echo $user->password;
        //check password
        if(!$user || ! Hash::check($fields['password'],$user->password)){

            return response([
                'message'=> 'Bad Credentials'
            ],401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $resonse = [
            'user'=>$user,
            'token'=>$token
        ];
        return response($resonse,201);
    }
}
