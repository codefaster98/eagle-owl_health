<?php

namespace App\Http\Requests\api\form_request;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestContactRequest extends FormRequest
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
            'fname' => "required|min:3|max:25",
            'lname' => "required|min:3|max:25",
            "phone" => "required|min_digits:11|max_digits:15",
            'email' => "required|email",
            'message' => "required|max:250",
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
