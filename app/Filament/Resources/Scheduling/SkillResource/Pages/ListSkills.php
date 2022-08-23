<?php

namespace App\Filament\Resources\Scheduling\SkillResource\Pages;

use App\Filament\Resources\Scheduling\SkillResource;
use App\Filament\Widgets\SkillOverview;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkills extends ListRecords
{
    protected static string $resource = SkillResource::class;

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SkillOverview::class
        ];
    }
}
