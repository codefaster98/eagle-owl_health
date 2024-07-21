<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsEventUsersM extends Model
{
    use HasFactory;
    protected $fillable = [
        'events_id',
        'users_id',
        'payment_id',
        'payment_details',
        'time',
    ];
}
