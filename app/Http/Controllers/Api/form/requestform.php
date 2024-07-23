<?php

namespace App\Http\Controllers\api\form;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormRequestFormRequest;
use App\Services\users\FormRequrstFormServices;
use App\Services\system\SystemApiResponseServices;

class requestform extends Controller
{
    public function form(FormRequestFormRequest $request)
    {
        try {
            $user = DB::transaction(function () use ($request) {
                // add user to database
                return FormRequrstFormServices::form($request->validated());
            });
            // return response
            if ($user) {
                return  SystemApiResponseServices::ReturnSuccess(
                    [],
                    __("return_messages.form_request_form.MessageSucc"),
                    null
                );
            } else {
                return  SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.form_request_form.MessageFailed"),
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
