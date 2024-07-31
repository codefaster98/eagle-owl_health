<?php

namespace App\Http\Requests\api\events;

use Illuminate\Foundation\Http\FormRequest;

class EventsEventsGetAllRequest extends FormRequest
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
            "limit" => is_null($this->limit) ? 50 : (int) $this->limit,
            "random" => is_null($this->random) || !in_array($this->random, ["yes", "no"]) ? false : ($this->random == "yes" ? true : false),
        ]);
    }
    public function rules(): array
    {
        return [
            'limit' => "required|integer",
            'random' => "required|boolean",
            'date' => 'sometimes|string',
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
