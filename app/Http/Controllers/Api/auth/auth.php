<?php

namespace App\Http\Controllers\Api\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\users\UsersUsersServices;
use App\Http\Requests\api\auth\AuthLoginRequest;
use App\Http\Requests\api\auth\AuthVerifyRequest;
use App\Services\system\SystemApiResponseServices;
use App\Http\Requests\api\auth\AuthRegisterRequest;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Http\Requests\api\auth\AuthForgetPasswordRequest;
use App\Http\Requests\api\auth\AuthUpdateRequest;
use App\Http\Requests\api\auth\AuthValidateOtpRequest;

class auth extends Controller
{
    //
    public function Register(AuthRegisterRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                // add user to database
                return UsersUsersServices::Register($request->validated());
            });
            // return response
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    ["user" => $user],
                    __("return_messages.user_users.RegisterSucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.RegisterFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }

    public function Login(AuthLoginRequest $request)
    {
        try {
            $token = DB::transaction(function () use ($request) {
                // add user to database
                return UsersUsersServices::Login($request->email, $request->password);
            });
            // return response
            if ($token) {
                return  SystemApiResponseServices::ReturnSuccess(
                    $token,
                    __("return_messages.user_users.LoginSucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.LoginFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }

    public function Verify(AuthVerifyRequest $request)
    {
        try {
            $token = DB::transaction(function () use ($request) {
                // add user to database
                return UsersUsersServices::Verify($request->user_code, $request->otp);
            });
            // return response
            if ($token) {
                return  SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("return_messages.user_users.VerifySucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.VerifyFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }

    public function Logout()
    {

        try {

            \Tymon\JWTAuth\Facades\JWTAuth::invalidate(\Tymon\JWTAuth\Facades\JWTAuth::getToken());
            auth()->logout();
            if (!auth()->check()) {
                return SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("return_messages.user_users.LogoutSucc"),
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.LogoutFailed"),
                    null
                );
            }

        } catch (\Throwable $th) {
            // التعامل مع الأخطاء وإرجاع رسالة خطأ مناسبة
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }

    }

    public function UpdateProfile(AuthUpdateRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                return UsersUsersServices::UpdateProfile($request->validated());
            });
            // dd($user);
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    ["user" => $user],
                    __("return_messages.user_users.UpdateSucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.UpdateFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }

    public function ForgetPassword(AuthForgetPasswordRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                // add user to database
                return UsersUsersServices::ForgetPassword($request->validated());
            });
            // return response
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("return_messages.user_users.SendSucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.SendFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }

    public function ValidateOTP(AuthValidateOtpRequest $request)
    {
        try {
            $token = DB::transaction(function () use ($request) {
                // add user to database
                return UsersUsersServices::ValidateOTP($request->user_code, $request->otp);
            });
            // return response
            if ($token) {
                return  SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("return_messages.user_users.VerifySucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.VerifyFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }
    
}
