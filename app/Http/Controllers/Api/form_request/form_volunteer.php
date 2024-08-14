<?php

namespace App\Http\Controllers\Api\form_request;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\system\SystemApiResponseServices;
use App\Services\users\FormVolunteerClubFormServices;
use App\Http\Requests\api\form_request\FormVolunteerClubFormRequest;

class form_volunteer extends Controller
{
    public function Volunteer(FormVolunteerClubFormRequest $request): JsonResponse
    {
        try {
            $form_request = DB::transaction(function () use ($request) {
                // Add form request
                return FormVolunteerClubFormServices::Volunteer($request->validated());
            });

            if ($form_request) {
                return SystemApiResponseServices::ReturnSuccess([], __("return_messages.form_request.AddSucc"), null);
            } else {
                return SystemApiResponseServices::ReturnFailed([], __("return_messages.form_request.AddFailed"), null);
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
