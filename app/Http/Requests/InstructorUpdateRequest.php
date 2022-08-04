<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:instructors,email'],
            'phone_number' => ['required', 'string', 'unique:instructors,phone_number'],
            'password' => ['required', 'password'],
            'email_verified_at' => ['required', 'email'],
            'banned_at' => ['required'],
            'remember_token' => ['string'],
            'softdeletes' => ['required'],
        ];
    }
}
