<?php

namespace App\Http\Controllers\Api\form_request;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\form_request\FormRequestAddNewRequest;
use App\Services\system\SystemApiResponseServices;
use App\Services\users\FormRequrstFormServices;
use Illuminate\Support\Facades\DB;

class form_request extends Controller
{
    public function Add(FormRequestAddNewRequest $request)
    {
        try {
            $form_request =  DB::transaction(function () use ($request) {
                // add form request
                return FormRequrstFormServices::Add($request->validated());
            });
            if ($form_request) {
                return SystemApiResponseServices::ReturnSuccess([], __("return_messages.form_request.AddSucc"), null);
            } else {
                return SystemApiResponseServices::ReturnFailed([], __("return_messages.form_requesy.AddFailed"), null);
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
