<?php

namespace App\Http\Requests\api\auth;

use App\Services\users\UsersUsersServices;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Number;

class AuthRegisterRequest extends FormRequest
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
        $this->merge([
            'code' => UsersUsersServices::GenerateNewCode(),
            "otp" => rand(123652, 986412),
            "active" => false,
            "deleted" => false,
        ]);
    }

    public function rules(): array
    {
        return [
            "code" => "required|unique:users_users,code",
            "fname" => "required|string|max:20",
            "lname" => "required|string|max:20",
            "email" => "required|email|unique:users_users,email",
            "phone" => "required|min_digits:11|max_digits:15",
            "password" => "required|confirmed",
            "active" => "required|boolean",
            "deleted" => "required|boolean",
            "otp" => "required|numeric",
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
