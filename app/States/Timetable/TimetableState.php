<?php

namespace App\States\Timetable;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class TimetableState extends State
{
    /**
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(NotStarted::class)
            ->allowTransition(NotStarted::class, NotStarted::class)
            ->allowTransition(NotStarted::class, OnGoing::class)
            ->allowTransition(OnGoing::class, OnGoing::class)
            ->allowTransition(OnGoing::class, Complete::class)
            ->allowTransition(Complete::class, Complete::class);
    }
}
