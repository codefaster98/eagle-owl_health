<?php

namespace App\Services\users;

use App\Models\Form\FormRequestFormM;

class FormRequrstFormServices
{
    static public function Add(array $data)
    {
        // add request in database
        $user = FormRequestFormM::create($data);
        // send message to admin
        // Mail::to($user->email)->send(new VerifyCodeEmail($user->otp));
        return $user;
    }
}
