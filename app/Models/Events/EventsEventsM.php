<?php

namespace App\Models\Events;

use App\Models\Speakers\SpeakersSpeakersM;
use App\Models\Users\UsersUsersM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsEventsM extends Model
{
    use HasFactory;
    protected $table = "events_events";
    public $timestamps = false;

    protected $fillable = [
        'code',
        'image',
        'title_en',
        'title_ar',
        'short_desc_en',
        'short_desc_ar',
        'long_desc_en',
        'long_desc_ar',
        'price',
        'date',
        'from_time',
        'to_time',
        'location',
        'date_details'
    ];
    public function Speakers()
    {
        return $this->belongsToMany(
            SpeakersSpeakersM::class,
           'events_event_speakers',
            'events_id',
            'speakers_id'
        );
    }
    public function users()
    {
        return $this->belongsToMany(
            UsersUsersM::class,
            'events_event_users',
            'events_id',
            'users_id'
    );
    }

}
