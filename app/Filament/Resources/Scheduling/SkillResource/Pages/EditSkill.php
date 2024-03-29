<?php

namespace App\Filament\Resources\Scheduling\SkillResource\Pages;

use App\Filament\Resources\Scheduling\SkillResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkill extends EditRecord
{
    protected static string $resource = SkillResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
