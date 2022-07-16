<?php

namespace App\States\Appointment;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class AppointmentState extends State
{

    public function color(): string {}

    /**
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, OnGoing::class)
            ->allowTransition(OnGoing::class, Complete::class);
    }
}
