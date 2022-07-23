<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'skill_id' => ['required', 'integer', 'exists:courses,id'],
            'status' => ['required', 'string'],
            'reference_code' => ['required', 'string'],
            'booked_at' => ['required'],
            'total_amount' => ['required', 'numeric'],
            'paid_amount' => ['required', 'numeric'],
            'due_amount' => ['required', 'numeric'],
        ];
    }
}
