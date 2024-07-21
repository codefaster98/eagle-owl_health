<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsEventsM extends Model
{
    use HasFactory;
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
    ];
}
