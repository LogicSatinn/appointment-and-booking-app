<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'payment_method' => ['required', 'string'],
            'paid_amount' => ['required', 'numeric', 'between:-999999.99,999999.99'],
            'total_amount' => ['required', 'numeric', 'between:-999999.99,999999.99'],
            'due_amount' => ['required', 'numeric', 'between:-999999.99,999999.99'],
            'status' => ['required', 'string'],
            'booking_id' => ['required', 'integer', 'exists:bookings,id'],
            'reference_code' => ['required', 'string'],
            'softdeletes' => ['required'],
        ];
    }
}
