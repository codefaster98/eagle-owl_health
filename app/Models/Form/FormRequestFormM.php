<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequestFormM extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
}
