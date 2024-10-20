<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsEventUsersM extends Model
{
    use HasFactory;
    protected $table = "events_event_users";
    public $timestamps = false;

    protected $fillable = [
        'events_id',
        'users_id',
        'payment_id',
        'payment_details',
        'time',
    ];
    public function Event()
    {
        return $this->belongsTo(EventsEventsM::class, 'events_id');

    }
}
