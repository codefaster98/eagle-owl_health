<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormVolunteerClubFormM extends Model
{
    public $timestamps = false;
    protected $table = "form_volunteerClub_form";

    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'whatsapp',
        'age',
        'gender',
        'password',
        'education',
        'language',
        'social_media_links',
        'interest_administration',
        'interest_field_work',
        'interest_campaigning',
        'interest_volunteer_coordination',
        'interest_media_maintenance_gardening',
        'interest_health_wellness_disability',
        'interest_festivals_culture',
        'interest_other',
        'talent',
        'time_available',
        'skills',
        'other_notes',
    ];

    // تحديد الحقول التي يجب أن يتم تحويلها تلقائيًا إلى JSON
    protected $casts = [
        'interest_administration' => 'boolean',
        'interest_field_work' => 'boolean',
        'interest_campaigning' => 'boolean',
        'interest_volunteer_coordination' => 'boolean',
        'interest_media_maintenance_gardening' => 'boolean',
        'interest_health_wellness_disability' => 'boolean',
        'interest_festivals_culture' => 'boolean',
        'interest_other' => 'boolean',
        'age' => 'integer',
        'time_available' => 'string',
    ];
}
