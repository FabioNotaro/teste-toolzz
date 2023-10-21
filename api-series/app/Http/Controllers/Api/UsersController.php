<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Users\UserCreateResource;

class UsersController {

    public function store(Request $request){

        $data             = $request->all();
        $data['password'] = Hash::make($data['password']);
        $registeredEmail  = User::where('email', $data['email'])->first();

        if($registeredEmail){
            return response()->json(['message' => 'E-mail already registered!']);
        }else{
            $user = User::create($data);
            return UserCreateResource::make($user)->additional(['message' => 'User successfully registered!'], 201);
        };

    }

    public function authenticate(Request $request){
            
        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials) === false) {
            return response()->json('Unauthorized', 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('token', ['is_admin']);

        return response()->json($token->plainTextToken);

    }
}
