<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsEventSpeakersM extends Model
{
    use HasFactory;
    protected $table = "events_event_speakers";

    protected $fillable = [
        'events_id',
        'speakers_id',
    ];
}
