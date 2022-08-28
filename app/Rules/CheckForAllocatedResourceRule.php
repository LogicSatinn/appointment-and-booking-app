<?php

namespace App\Rules;

use App\Models\Timetable;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class CheckForAllocatedResourceRule implements Rule, DataAwareRule
{
    protected array $data = [];

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
    public function setData($data): static
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
    public function passes($attribute, $value): bool
    {
        return Timetable::where('resource_id', $this->data['data']['resource_id'])
            ->whereBetween('from', [$this->data['data']['from'], $this->data['data']['to']])
            ->whereBetween('to', [$this->data['data']['from'], $this->data['data']['to']])
            ->whereBetween('start', [$this->data['data']['start'], $this->data['data']['end']])
            ->whereBetween('end', [$this->data['data']['start'], $this->data['data']['end']])
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'This resource is allocated to another timetable. Change the time or date.';
    }
}
