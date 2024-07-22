<?php
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
            null,
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