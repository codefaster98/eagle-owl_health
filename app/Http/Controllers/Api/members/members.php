<?php

namespace App\Http\Controllers\api\members;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\memberships\MembershipsMembershipsGetAllRequest;
use App\Services\system\SystemApiResponseServices;
use App\Services\members\MembersMembersServices;


class members extends Controller
{
    public function GetAll(MembershipsMembershipsGetAllRequest $request)
    {
        try {
            if ($request->random) {
                $memberships = MembersMembersServices::GetAllWithLimitAndRandom(null, $request->limit);
            } else {
                $memberships = MembersMembersServices::GetAllWithLimit(null, $request->limit);
            }

            if (count($memberships) > 0) {
                return SystemApiResponseServices::ReturnSuccess($memberships, null, null);
            } else {
                return SystemApiResponseServices::ReturnFailed([], __("return_messages.members_members.NotFound"), null);
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

