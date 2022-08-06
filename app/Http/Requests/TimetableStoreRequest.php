<?php

namespace App\Http\Requests;

use App\Enums\SkillLevel;
use App\Rules\CheckForAllocatedResourceRule;
use App\States\Timetable\NotStarted;
use App\States\Timetable\TimetableState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Spatie\ModelStates\Validation\ValidStateRule;

class TimetableStoreRequest extends FormRequest
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
        $this->merge([
            'status' => NotStarted::class,
            'slug' => $this->get('title'),
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
            'from' => ['required', 'date_format:d/m/Y', 'after_or_equal:today', 'before_or_equal:to'],
            'to' => ['required', 'date_format:d/m/Y', 'after_or_equal:today', 'after_or_equal:from'],
            'start' => ['required', 'date_format:H:i', 'before:end'],
            'end' => ['required', 'date_format:H:i', 'after:start'],
            'status' => ['required', new ValidStateRule(TimetableState::class)],
            'price' => ['required', 'numeric'],
            // 'resource_id' => ['required', 'integer', 'exists:resources,id', new CheckForAllocatedResourceRule()],
            'resource_id' => ['required', 'integer', 'exists:resources,id'],
            'skill_id' => ['required', 'integer', 'exists:skills,id'],
            'level' => ['required', new Enum(SkillLevel::class)],
        ];
    }
}
