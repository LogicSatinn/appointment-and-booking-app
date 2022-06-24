<?php

namespace App\Http\Requests;

use App\Enums\SkillStatus;
use Illuminate\Foundation\Http\FormRequest;

class SkillStoreRequest extends FormRequest
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


    public function prepareForValidation()
    {
        $this->merge([
            'status' => SkillStatus::DRAFT->value,
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
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'status' => ['required'],
            'skill_cover_photo' => ['required', 'file', 'image']
        ];
    }
}
