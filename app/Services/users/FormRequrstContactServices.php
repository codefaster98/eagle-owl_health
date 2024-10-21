<?php

namespace App\Services\users;

use Illuminate\Support\Facades\Mail;
use App\Models\Form\FormContactFormM;
use Filament\Notifications\Notification;

class FormRequrstContactServices
{
    static public function Contact(array $data)
    {
        // add request in database
        $user = FormContactFormM::create($data);
        $userName=$user->fname. " ".$user->lname;
        $messageBody = "A new Message Send From:{$userName}\n";
        $messageBody .= "Phone: {$user->phone}\n";
        $messageBody .= "Email: {$user->email}\n";
        $messageBody .= "Message: {$user->message}\n";
        Mail::raw($messageBody, function ($message) {
            $message->to('info@shima.org.sa')
                ->subject('New Form Request');
        });
        Notification::make()
        ->title('New Form Request')
        ->body("A new message from {$userName}.\n Phone: {$user->phone}\nEmail: {$user->email}\nMessage: {$user->message}")
        ->send();
        return $user;
    }
}
