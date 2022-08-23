<?php

namespace App\Filament\Resources\Scheduling\TimetableResource\Pages;

use App\Filament\Resources\Scheduling\TimetableResource;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTimetable extends ViewRecord
{
    protected static string $resource = TimetableResource::class;

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
