<?php

namespace App\Models\Speakers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeakersSpeakersM extends Model
{
    use HasFactory;
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
}
