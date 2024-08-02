<?php

namespace App\Services\users;

use App\Mail\users\VerifyCodeEmail;
use App\Models\Form\FormRequestFormM;
use Filament\Notifications\Notification;

class FormRequrstFormServices
{
    static public function Add(array $data)
    {
        // add request in database
        $user = FormRequestFormM::create($data);
        // send message to admin
        Notification::make()
            ->title('New Form Request')
            ->body("A new Message Send: {$user->message}")
            ->sendTo('bhry@bhry.local');
        return $user;
    }
}
