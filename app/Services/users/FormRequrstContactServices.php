<?php

namespace App\Services\users;

use App\Models\Form\FormContactFormM;

class FormRequrstContactServices
{
    static public function Contact(array $data)
    {
        // add request in database
        $user = FormContactFormM::create($data);
        return $user;
    }
}
