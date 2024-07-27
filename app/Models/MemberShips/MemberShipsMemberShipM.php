<?php

namespace App\Models\MemberShips;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShipsMemberShipM extends Model
{
    use HasFactory;
    protected $table = "memberships_member_ship";
    public $timestamps = false;

    protected $fillable = [

        'code',
        'name_en',
        'name_ar',
        'list_en',
        'list_ar',
        'amount',
    ];
    protected $casts = [
        'list_en' => "array",
        'list_ar' => "array",
    ];
}
