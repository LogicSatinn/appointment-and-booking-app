<?php

namespace App\Filament\Resources\Scheduling\TimetableResource\Pages;

use App\Filament\Resources\Scheduling\TimetableResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTimetable extends CreateRecord
{
    protected static string $resource = TimetableResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
