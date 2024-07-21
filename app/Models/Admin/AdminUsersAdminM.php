<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUsersAdminM extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'fname',
        'lname',
        'email',
        'password',
        'phone',
        'active',
        'deleted'
    ];
}
