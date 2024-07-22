<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\api\auth\RegisterRequest;

class register extends Controller
{
    public function register(RegisterRequest $request){

        $newUser=$request->validated();
        $newUser['password']=Hash::make($newUser['password']);
        $user=User::create($newUser);
        $success['token']=$user->createToken('user',['app:all'])->plainTextToken;
        $success['user']=$newUser;
        return response()->json($success,200);
    }
}
