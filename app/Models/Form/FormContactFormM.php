<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormContactFormM extends Model
{
    public $timestamps = false;
    protected $table = "form_contact_form";

    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'message',
    ];
}
