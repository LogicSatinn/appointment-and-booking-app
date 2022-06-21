<?php

namespace App\Http\Requests;

use App\States\Resource\Available;
use App\States\Resource\ResourceState;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\ModelStates\Validation\ValidStateRule;

class ResourceStoreRequest extends FormRequest
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
        $this->merge(['state' => Available::class]);
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
            'capacity' => ['required', 'integer'],
            'state' => ['required', new ValidStateRule(ResourceState::class)],
            'note' => ['nullable', 'string']
        ];
    }
}
