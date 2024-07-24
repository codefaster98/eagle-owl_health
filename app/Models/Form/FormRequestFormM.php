<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequestFormM extends Model
{
    public $timestamps = false;
    protected $table = "form_request_form";

    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
}
