<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

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
