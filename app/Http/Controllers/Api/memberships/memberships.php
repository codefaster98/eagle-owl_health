<?php

namespace App\Http\Controllers\Api\memberships;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\memberships\MembershipsMembershipsGetAllRequest;
use App\Services\memberships\MembershipsMembershipsServices;
use App\Services\system\SystemApiResponseServices;
use App\Services\users\MemberShipsMembershipServices;

class memberships extends Controller
{
    public function GetAll(MembershipsMembershipsGetAllRequest $request)
    {
        try {
            if ($request->random) {
                $memberships = MembershipsMembershipsServices::GetAllWithLimitAndRandom(null, $request->limit);
            } else {
                $memberships = MembershipsMembershipsServices::GetAllWithLimit(null, $request->limit);
            }

            if (count($memberships) > 0) {
                return SystemApiResponseServices::ReturnSuccess($memberships, null, null);
            } else {
                return SystemApiResponseServices::ReturnFailed([], __("return_messages.memberships_member_ship.NotFound"), null);
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }
    // protected $memberService;

    // public function __construct(MemberShipsMembershipServices $memberService)
    // {
    //     $this->memberService = $memberService;
    // }
    // public function memberShips(Request $request): JsonResponse
    // {
    //     try {
    //         $language = $request->query('lang', 'en');

    //         $data = DB::transaction(function () use ($language) {
    //             return $this->memberService->memberShips($language);
    //         });

    //         if ($data) {
    //             return SystemApiResponseServices::ReturnSuccess(
    //                 ["data" => $data],
    //                 null,
    //                 null
    //             );
    //         } else {
    //             return SystemApiResponseServices::ReturnFailed(
    //                 [],
    //                 __("return_messages.memberships_member_ship.Failed"),
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
    // public function show(Request $request, $id): JsonResponse
    // {
    //     try {
    //         $language = $request->query('lang', 'en');
    //         $data = DB::transaction(function () use ($id, $language) {
    //             return $this->memberService->show($id, $language);
    //         });

    //         if ($data) {
    //             return SystemApiResponseServices::ReturnSuccess(
    //                 ["data" => $data],
    //                 null,
    //                 null
    //             );
    //         } else {
    //             return SystemApiResponseServices::ReturnFailed(
    //                 [],
    //                 __("return_messages.memberships_member_ship.Failed"),
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
}
