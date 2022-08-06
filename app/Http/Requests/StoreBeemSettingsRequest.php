<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeemSettingsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'beem_api_key' => ['required', 'string'],
            'beem_secret_key' => ['required', 'string'],
            'beem_sender_name' => ['nullable', 'string', 'min:3', 'max:19'],
        ];
    }
}
