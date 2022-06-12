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
    public function authorize()
    {
        return true;
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
            'duration' => ['required'],
            'appointment_time' => ['required'],
            'resource_id' => ['required', 'integer', 'exists:resources,id'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'softdeletes' => ['required'],
        ];
    }
}
