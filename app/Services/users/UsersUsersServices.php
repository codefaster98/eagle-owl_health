<?php

namespace App\Services\users;

use Illuminate\Support\Str;
use App\Models\Users\UsersUsersM;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\users\VerifyCodeEmail;
use Illuminate\Support\Facades\Mail;

class UsersUsersServices
{
    static public function GenerateNewCode()
    {
        $code = Str::random(5);
        if (UsersUsersM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }
    static public function Register(array $data)
    {
        // add user in database
        $user = UsersUsersM::create($data);
        // verify user email (send mail)
        Mail::to($user->email)->send(new VerifyCodeEmail($user->otp));
        return $user;
    }
    static public function Login($email, $password)
    {
        $token =auth("api")->attempt([
            "email" => $email,
            "password" => $password,
        ]);
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return $token ? $data : null;
    }
    static public function Logout()
    {
        return auth()->logout();
        return auth("api")->user();
        return auth("api")->logout();



    }
    static public function Verify($user_code, $otp_code)
    {
        // check if $user_code and $otp_code exists
        $user = UsersUsersM::where([
            "code" => $user_code,
            "otp" => $otp_code,
        ])->first();
        if ($user) {
            // set active = true
            $user->active = true;
            // set otp = null
            $user->otp = null;
            // save user
            $user->save();
            // return true
            return true;
        } else {
            return false;
        }
    }
}
