<?php

namespace App\Services\users;

use App\Mail\users\VerifyCodeEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Form\FormRequestFormM;
use Filament\Notifications\Notification;

class FormRequrstFormServices
{
    static public function Add(array $data)
    {
        // add request in database
        $user = FormRequestFormM::create($data);
        // send message to admin
        $messageBody = "A new Message Send From:{$user->name}\n";
        $messageBody .= "Phone: {$user->phone}\n";
        $messageBody .= "Email: {$user->email}\n";
        $messageBody .= "Message: {$user->message}\n";
        Mail::raw($messageBody, function ($message) {
            $message->to('shimaa0mohamed19@gmail.com')
                ->subject('New Volunteer Application');
        });
        Notification::make()
        ->title('New Volunteer Application')
        ->body("A new message from {$user->name}.\nPhone: {$user->phone}\nEmail: {$user->email}\nMessage: {$user->message}")
        ->send();
        return $user;
    }
}
