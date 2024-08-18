<?php

namespace App\Http\Controllers\Api\auth;

use Illuminate\Http\Request;
use App\Models\Users\UsersUsersM;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\users\UsersUsersServices;
use App\Http\Requests\api\auth\AuthLoginRequest;
use App\Http\Requests\api\auth\AuthUpdateRequest;
use App\Http\Requests\api\auth\AuthVerifyRequest;
use App\Services\system\SystemApiResponseServices;
use App\Http\Requests\api\auth\AuthRegisterRequest;
use App\Http\Requests\api\auth\AuthValidateOtpRequest;
use App\Http\Requests\api\auth\AuthResetPasswordRequest;
use App\Http\Requests\api\auth\EmailVerificationRequest;
use App\Http\Requests\api\auth\AuthForgetPasswordRequest;

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
            $data = DB::transaction(function () use ($request) {

                return UsersUsersServices::Login($request->email, $request->password);
            });


            if ($data) {

                $user = UsersUsersM::where('email', $request->email)->first();


                if ($user) {
                    $data['code'] = $user->code;
                $data['fname'] = $user->fname;

                    return SystemApiResponseServices::ReturnSuccess(
                        $data,
                        __("return_messages.user_users.LoginSucc"),
                        null
                    );
                } else {
                    return SystemApiResponseServices::ReturnFailed(
                        [],
                        __("return_messages.user_users.LoginFailed"),
                        null
                    );
                }
            } else {
                return SystemApiResponseServices::ReturnFailed(
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
    public function ResendOtp(EmailVerificationRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                return UsersUsersServices::ResendOtp($request->email);
            });

            if ($user) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["user" => $user],
                    __("return_messages.user_users.ResendOtpSucc"),
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.UserNotFound"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9801,
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
                return UsersUsersServices::ValidateOTP($request->otp);
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

    static public function ResetPassword(AuthResetPasswordRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                // dd($request);
                // add user to database
                // $validatedData = $request->validated();
                // dd($validatedData);
                return UsersUsersServices::ResetPassword($request->validated());
            });
            //    dd($user);
            // return response
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("return_messages.user_users.ResetSucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.ResetFailed"),
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
    static public function deleteUser($user_code)
    {
        try {
            $user = DB::transaction(function () use ($user_code) {
                return  UsersUsersServices::deleteUser($user_code);
            });
               // dd($user);
            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => __('return_messages.user_users.UserDeletedSuccessfully')
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => __('return_messages.user_users.UserNotFound')
                ], 404);
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }
    public function getUserInfo(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'code' => $user->code,
            'fname' => $user->fname,
            'lname' => $user->lname,
            'phone' => $user->phone,
            'email' => $user->email,
            'password' => $user->password,
        ]);
    }
}
