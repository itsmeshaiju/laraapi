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

    // public function login(Request $request){
    //     $fields = $request->validate([
    //         'name'=>'required|string',
    //         'password'=>'required|string'
    //     ]);

    //     if(User::auth($fields)){

    //     }
    // }
}
