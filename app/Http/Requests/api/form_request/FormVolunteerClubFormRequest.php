<?php

namespace App\Http\Requests\api\form_request;
use Illuminate\Foundation\Http\FormRequest;

class FormVolunteerClubFormRequest extends FormRequest
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
            // "limit" => is_null($this->limit) ? 50 : (int) $this->limit,
            // "random" => is_null($this->random) || !in_array($this->random, ["yes", "no"]) ? false : ($this->random == "yes" ? true : false),
        ]);
    }
    public function rules(): array
    {
        return [
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => 'required|email',
            'phone' => 'required|string|min:11|max:15',
            'whatsapp' => 'required|string|min:11|max:15',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|in:male,female,other',
            'password' => 'required|confirmed',
            'education' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'social_media_links' => 'nullable|url',

            'interest_administration' => 'nullable|boolean',
            'interest_field_work' => 'nullable|boolean',
            'interest_campaigning' => 'nullable|boolean',
            'interest_volunteer_coordination' => 'nullable|boolean',
            'interest_media_maintenance_gardening' => 'nullable|boolean',
            'interest_health_wellness_disability' => 'nullable|boolean',
            'interest_festivals_culture' => 'nullable|boolean',
            'interest_other' => 'nullable|boolean',

            'talent' => 'nullable|string|max:255',
            'time_available' => 'nullable|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'skills' => 'nullable|string',
            'other_notes' => 'nullable|string',
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
