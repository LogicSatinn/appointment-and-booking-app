<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralSettingsRequest extends FormRequest
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
            'site_name' => ['required', 'string'],
            'contact_email' => ['required', 'string', 'email'],
            'contact_phone_number' => ['required'],
            'facebook_social_media_link' => ['nullable', 'url', 'string'],
            'twitter_social_media_link' => ['nullable', 'url', 'string'],
            'instagram_social_media_link' => ['nullable', 'url', 'string'],
            'address' => ['required', 'string']
        ];
    }
}
