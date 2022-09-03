<?php

namespace App\Filament\Widgets;

use App\Models\Skill;
use App\States\Skill\Archived;
use App\States\Skill\Published;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class SkillOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '100s';

    protected function getCards(): array
    {
        return [
            Card::make('Total Skills', Skill::count()),
            Card::make('Published Skills', Skill::whereState('status', Published::class)->count()),
            Card::make('Archived Skills', Skill::whereState('status', Archived::class)->count()),
        ];
    }
}
