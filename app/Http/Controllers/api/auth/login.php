<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
    public function login(LoginRequest $request)
    {
        $newUser = $request->validated();
        $remember = !empty($request->remember) ? true : false;
        if (!$token = auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }
         $tokens=$this->createNewToken($token);
        return response()->json([$newUser,$tokens], 200);
    }
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
