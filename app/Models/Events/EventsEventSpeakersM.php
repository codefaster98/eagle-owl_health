<?php

namespace App\Models\Events;

use App\Models\Speakers\SpeakersSpeakersM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsEventSpeakersM extends Model
{
    use HasFactory;
    protected $table = "events_event_speakers";
    public $timestamps = false;

    protected $fillable = [
        'events_id',
        'speakers_id',
    ];
    public function Speaker()
    {
        return $this->belongsTo(SpeakersSpeakersM::class, 'speakers_id');

    }
}
