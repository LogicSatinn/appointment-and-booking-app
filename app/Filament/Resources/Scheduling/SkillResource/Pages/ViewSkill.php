<?php

namespace App\Filament\Resources\Scheduling\SkillResource\Pages;

use App\Filament\Resources\Scheduling\SkillResource;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSkill extends ViewRecord
{
    protected static string $resource = SkillResource::class;

    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
