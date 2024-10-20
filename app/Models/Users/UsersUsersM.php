<?php

namespace App\Models\Users;

use App\Models\Events\EventsEventsM;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersUsersM extends Authenticatable  implements JWTSubject
{
    public $timestamps = false;
    protected $table = "users_users";
    protected $fillable = [
        'code',
        'fname',
        'lname',
        'email',
        'password',
        'phone',
        'otp',
        'member_id',
        'is_member',
        'active',
        'deleted',
    ];
    protected $hidden = [
        'id',
        'otp',
        'member_id',
        'is_member',
        'active',
        'deleted',
        'password',
    ];
    public function events()
    {
        return $this->belongsToMany(
            EventsEventsM::class,
            'events_event_users',
            'users_id',
            'events_id',
    );
    }
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
