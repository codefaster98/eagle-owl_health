<?php

namespace App\Services\users;

use Illuminate\Support\Str;
use App\Models\Users\UsersUsersM;
use App\Mail\users\VerifyCodeEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\users\ResetPasswordCode;
use Illuminate\Support\Facades\Password;

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
        $token = auth("api")->attempt([
            "email" => $email,
            "password" => $password,
        ]);
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return $token ? $data : null;
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

    static public function Logout()
    {
        return auth()->logout();
        return auth("api")->user();
        return auth("api")->logout();
    }

    static public function UpdateProfile(array $data)
    {
        // $user = UsersUsersM::update($data);
        $user = auth()->user();
        if (!$user) {
            throw new \Exception('User not found.');
        }
        $user->update([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => isset($data['password']) ? bcrypt($data['password']) : $user->password,
        ]);
        return $user;
    }

    static public function ForgetPassword($email)
    {
        $user = UsersUsersM::where('email', $email)->first();
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->active=false;
        $user->save();
        Mail::to($user->email)->send(new ResetPasswordCode($otp));
        return $user;
    }

    static public function ValidateOTP($user_code, $otp_code)
    {
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

    static public function ResetPassword(array $data)
    {
        //get user
        $user = UsersUsersM::where(
            'email', $data['email']
            )->first();
        if ($user) {
            $user->update([
                'password' => $data['password'],

                $user->active=true,
                $user->save()
            ]);
            return $user;
        }
    }
}
