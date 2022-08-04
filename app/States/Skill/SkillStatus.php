<?php

namespace App\States\Skill;

use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class SkillStatus extends State
{
    /**
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Draft::class)
            ->allowTransition(Draft::class, Archived::class)
            ->allowTransition(Draft::class, Published::class)
            ->allowTransition(Archived::class, Published::class)
            ->allowTransition(Published::class, Archived::class);
    }
}
