<?php

namespace App\States\Resource;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ResourceState extends State
{
    abstract public function color(): string;

    /**
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Available::class)
            ->allowTransition(Available::class, Available::class)
            ->allowTransition(Available::class, InSession::class)
            ->allowTransition(InSession::class, InSession::class)
            ->allowTransition(InSession::class, Available::class);
    }
}
