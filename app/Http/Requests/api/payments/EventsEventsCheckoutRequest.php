<?php

namespace App\Http\Requests\api\payments;
use App\Services\users\UsersUsersServices;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Number;

class EventsEventsCheckoutRequest extends FormRequest
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
            // "user" => $this->route("user"),
            // "event" => $this->route("event"),
        ]);
    }
    public function rules(): array
    {
        return [
            'event_code' => "required|exists:events_events,code",
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
