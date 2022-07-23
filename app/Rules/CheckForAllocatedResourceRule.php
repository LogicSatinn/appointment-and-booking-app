<?php

namespace App\Rules;

use App\Models\Timetable;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class CheckForAllocatedResourceRule implements Rule, DataAwareRule
{

    protected $data = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Timetable::where('resource_id', $this->data['resource_id'])
            ->where('from', $this->data['from'])
            ->orWhere('to', $this->data['to'])
            ->where('start', $this->data['start'])
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This resource is allocated to another timetable. Change the time or date.';
    }
}
