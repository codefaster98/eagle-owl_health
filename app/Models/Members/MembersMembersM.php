<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembersMembersM extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'title_en',
        'title_ar',
        'name_en',
        'name_ar',
        'desc_en',
        'desc_ar',
        'image',
        'facebook',
        'twitter',
        'website',
    ];
}
