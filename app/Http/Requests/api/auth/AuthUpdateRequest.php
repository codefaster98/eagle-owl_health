<?php

namespace App\Http\Requests\api\auth;

use App\Services\users\UsersUsersServices;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Number;

class AuthUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    protected function prepareForValidation(): void
    {
        $this->merge([]);
    }

    public function rules(): array
    {
        return [
            "fname" => "nullable|string|max:20",
            "lname" => "nullable|string|max:20",
            "email" => "nullable|email",
            "phone" => "nullable|min_digits:11|max_digits:15",
            "password" => "nullable|required",
        ];
    }

    public function attributes(): array
    {
        return [];
    }
    public function messages(): array
    {
        return [];
    }
}
