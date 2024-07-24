<?php

namespace App\Http\Controllers\Api\memberships;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\system\SystemApiResponseServices;
use App\Services\users\MemberShipsMembershipServices;

class memberships extends Controller
{
    protected $memberService;

    public function __construct(MemberShipsMembershipServices $memberService)
    {
        $this->memberService = $memberService;
    }
    public function memberShips(Request $request): JsonResponse
    {
        try {
            $language = $request->query('lang', 'en');

            $data = DB::transaction(function () use ($language) {
                return $this->memberService->memberShips($language);
            });

            if ($data) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["members" => $data],
                    null,
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.members_members.FetchFailed"),
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
