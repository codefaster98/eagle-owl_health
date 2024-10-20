<?php

namespace App\Http\Controllers\Api\User;
use Illuminate\Http\Request;
use App\Services\users\UsersUsersServices;
use App\Services\system\SystemApiResponseServices;
use Illuminate\Routing\Controller as BaseController;

class my extends  BaseController

{
   public function myCalender()
    {
      try {

        $events = UsersUsersServices::myCalender();
        // dd($events);
        if ($events) {
            return SystemApiResponseServices::ReturnSuccess(
                ["MyCalender" => $events],
                null,
                null
            );
        } else {
            return SystemApiResponseServices::ReturnError(401, null, "No Subscrib Events yet");
        }
        } catch (\Throwable $th) {
        return SystemApiResponseServices::ReturnError(
            9800,
            null,
            $th->getMessage()
        );
        }
    }

    public function ProfileByCode(Request $request)
    {
        try {
            $code = $request->input('code');

            if (!$code) {
                return SystemApiResponseServices::ReturnError(400, null, "Code is required");
            }

            // جلب المستخدم مع الأحداث المرتبطة به
            $userWithRelations = UsersUsersServices::getUserByCodeWithRelations($code, ['events']);

            if ($userWithRelations) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["user" => $userWithRelations], // سيظهر الأحداث تحت المستخدم هنا
                    null,
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnError(404, null, "User not found");
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage()
            );
        }
    }


}
