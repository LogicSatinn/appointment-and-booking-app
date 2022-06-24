<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->get('title')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'from' => ['nullable', 'date_format:d/m/Y', 'after_or_equal:today', 'before_or_equal:to'],
            'to' => ['nullable', 'date_format:d/m/Y', 'after_or_equal:today', 'after_or_equal:from'],
            'start' => ['nullable', 'date_format:H:i', 'before:end'],
            'end' => ['nullable', 'date_format:H:i', 'after:start'],
            'price' => ['nullable', 'numeric'],
            'resource_id' => ['nullable', 'integer', 'exists:resources,id'],
            'skill_id' => ['nullable', 'integer', 'exists:skills,id'],
        ];
    }
}
