<?php

namespace App\Models\MemberShips;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShipsMemberShipM extends Model
{
    use HasFactory;
    protected $fillable = [

        'name_en',
        'name_ar',
        'list_en',
        'list_ar',
        'amount',
    ];
}
