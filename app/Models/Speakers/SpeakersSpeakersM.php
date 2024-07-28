<?php

namespace App\Models\Speakers;

use App\Models\Events\EventsEventsM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeakersSpeakersM extends Model
{
    protected $table = "speakers_speakers";
    public $timestamps = false;

    protected $fillable = [
        'code',
        'title_en',
        'title_ar',
        'name_en',
        'name_ar',
        'short_desc_en',
        'short_desc_ar',
        'long_desc_en',
        'long_desc_ar',
        'image',
        'facebook',
        'twitter',
        'website',
    ];
    public function events()
    {
        $this->belongsToMany(
            EventsEventsM::class,
            'event_speakers',
            'speakers_id',
            'events_id'
        );
        // return $this->belongsToMany(EventsEventsM::class);
    }
}
