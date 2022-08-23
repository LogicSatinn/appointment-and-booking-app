<?php

namespace App\Filament\Resources\Scheduling\TimetableResource\Pages;

use App\Filament\Resources\Scheduling\TimetableResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimetable extends EditRecord
{
    protected static string $resource = TimetableResource::class;

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
