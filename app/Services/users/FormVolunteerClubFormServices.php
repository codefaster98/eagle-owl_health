<?php

namespace App\Services\users;

use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use App\Models\Form\FormVolunteerClubFormM;

class FormVolunteerClubFormServices
{
    static public function Volunteer(array $data)
    {
        $volunteer = FormVolunteerClubFormM::create($data);
           // Build the message body for the email
        $messageBody = "A new volunteer application from: {$volunteer->fname} {$volunteer->lname}\n";
        $messageBody .= "Phone: {$volunteer->phone}\n";
        $messageBody .= "Email: {$volunteer->email}\n";

        // Dynamically add only interests that are true
        $interests = [
            'Administration' => $volunteer->interest_administration,
            'Field Work' => $volunteer->interest_field_work,
            'Campaigning' => $volunteer->interest_campaigning,
            'Volunteer Coordination' => $volunteer->interest_volunteer_coordination,
            'Media Maintenance/Gardening' => $volunteer->interest_media_maintenance_gardening,
            'Health/Wellness/Disability' => $volunteer->interest_health_wellness_disability,
            'Festivals/Culture' => $volunteer->interest_festivals_culture,
            'Other' => $volunteer->interest_other,
        ];

        // Add the "Interested in:" section if there are any true interests
        $interestedIn = [];
        foreach ($interests as $interestName => $hasInterest) {
            if ($hasInterest) {
                $interestedIn[] = $interestName;
            }
        }

        if (!empty($interestedIn)) {
            $messageBody .= "Interested in:\n";
            foreach ($interestedIn as $interestName) {
                $messageBody .= "- {$interestName}\n";
            }
        }

        // Add other details
        $messageBody .= "Talent: {$volunteer->talent}\n";
        $messageBody .= "Time Available: {$volunteer->time_available}\n";
        $messageBody .= "Skills: {$volunteer->skills}\n";
        $messageBody .= "Other Notes: {$volunteer->other_notes}\n";

        // Send the email
        Mail::raw($messageBody, function ($message) {
            $message->to('shimaa0mohamed19@gmail.com')
                ->subject('New Volunteer Application');
        });

        // Send a notification
        Notification::make()
            ->title('New Volunteer Application')
            ->body("A new volunteer application from {$volunteer->fname} {$volunteer->lname}.\nPhone: {$volunteer->phone}\nEmail: {$volunteer->email}")
            ->send();

        return $volunteer;
    }
}
