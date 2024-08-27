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
use Tymon\JWTAuth\Facades\JWTAuth;


class auth extends Controller
{
    //Register
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

    //Login
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

    //Verify Email
    public function Verify(AuthVerifyRequest $request)
{
    try {
        // Verify the user inside a transaction
        $user = DB::transaction(function () use ($request) {
            return UsersUsersServices::Verify($request->user_code, $request->otp);
        });

        // If user verification is successful
        if ($user) {
            // Generate the JWT token
            $token = JWTAuth::fromUser($user);

            // Return success response with the token
            return SystemApiResponseServices::ReturnSuccess(
                ['token' => $token],
                __("return_messages.user_users.VerifySucc"),
                null
            );
        } else {
            // Return failed response if verification fails
            return SystemApiResponseServices::ReturnFailed(
                [],
                __("return_messages.user_users.VerifyFailed"),
                null
            );
        }
    } catch (\Throwable $th) {
        // Return error response in case of an exception
        return SystemApiResponseServices::ReturnError(
            9800,
            null,
            $th->getMessage(),
        );
    }
}


    //ResendOtp To Verify Email
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

    //Logout
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

    //Update User Profile
    // public function UpdateProfile(AuthUpdateRequest $request)
    // {
    //     try {
    //         $user = DB::transaction(function () use ($request) {
    //             return UsersUsersServices::UpdateProfile($request->validated());
    //         });
    //         // dd($user);
    //         if ($user) {
    //             return  SystemApiResponseServices::ReturnSuccess(
    //                 ["user" => $user],
    //                 __("return_messages.user_users.UpdateSucc"),
    //                 null
    //             );
    //         } else {
    //             return  SystemApiResponseServices::ReturnFailed(
    //                 [],
    //                 __("return_messages.user_users.UpdateFailed"),
    //                 null
    //             );
    //         }
    //     } catch (\Throwable $th) {
    //         return SystemApiResponseServices::ReturnError(
    //             9800,
    //             null,
    //             $th->getMessage(),
    //         );
    //     }
    // }
    public function UpdateProfile(AuthUpdateRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                return UsersUsersServices::UpdateProfile($request->validated());
            });

            if ($user) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["user" => $user],
                    __("return_messages.user_users.UpdateSucc"),
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.UpdateFailed"),
                    null
                );
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Check if the error is related to the unique email validation
            if ($e->validator->errors()->has('email')) {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.EmailExists"),
                    null
                );
            }

            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $e->getMessage(),
            );
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle duplicate email error
            if ($e->errorInfo[1] == 1062) { // 1062 is the error code for duplicate entry
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.user_users.EmailExists"),
                    null
                );
            }

            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $e->getMessage(),
            );
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }


    //ForgetPassword
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

    //ValidateOTP
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

    //ResetPassword
    static public function ResetPassword(AuthResetPasswordRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
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

    //deleteUser
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

    //getUserInfo
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
