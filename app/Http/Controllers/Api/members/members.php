<?php

namespace App\Http\Controllers\api\members;

use App\Http\Controllers\Controller;
use App\Services\system\SystemApiResponseServices;
use Illuminate\Http\JsonResponse;
use App\Services\users\MembersMembersServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class members extends Controller
{

    protected $memberService;

    public function __construct(MembersMembersServices $memberService)
    {
        $this->memberService = $memberService;
    }
    public function getMembers(Request $request): JsonResponse
    {
        try {
            $language = $request->query('lang', 'en');

            $data = DB::transaction(function () use ($language) {
                return $this->memberService->getMembers($language);
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
    //Route::post('/getMembers', 'getMembers')->name("getMembers");

}

