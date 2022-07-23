<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
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
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'timetable_id' => ['required', 'integer', 'exists:timetables,id'],
            'booking_id' => ['required', 'integer', 'exists:bookings,id'],
            'seat_number' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'reference_code' => ['required', 'string'],
            'reserved_at' => ['required'],
            'softdeletes' => ['required'],
        ];
    }
}
