<?php

namespace App\Http\Requests;

use App\States\Appointment\AppointmentState;
use App\States\Appointment\Pending;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\ModelStates\Validation\ValidStateRule;

class AppointmentStoreRequest extends FormRequest
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


    /**
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge(['status' => Pending::class]);
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
            'from' => ['required', 'date_format:d/m/Y', 'after_or_equal:today', 'before_or_equal:to'],
            'to' => ['required', 'date_format:d/m/Y', 'after_or_equal:today', 'after_or_equal:from'],
            'start' => ['required', 'date_format:H:i', 'before:end'],
            'end' => ['required', 'date_format:H:i', 'after:start'],
            'status' => ['required', new ValidStateRule(AppointmentState::class)],
            'price' => ['required', 'numeric'],
            'resource_id' => ['required', 'integer', 'exists:resources,id'],
            'skill_id' => ['required', 'integer', 'exists:skills,id'],
        ];
    }
}
