<?php

namespace App\States\Payment;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PaymentState extends State
{
    /**
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Complete::class)
            ->allowTransition(Pending::class, Partial::class)
            ->allowTransition(Partial::class, Complete::class);
    }
}
