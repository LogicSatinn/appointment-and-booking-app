<?php

namespace App\Filament\Resources\Scheduling\TimetableResource\Pages;

use App\Filament\Resources\Scheduling\TimetableResource;
use App\Models\Timetable;
use Filament\Resources\Pages\CreateRecord;

class CreateTimetable extends CreateRecord
{
    protected static string $resource = TimetableResource::class;

    protected function beforeCreate(): void
    {
        if (
            Timetable::where('resource_id', $this->data['resource_id'])
            ->whereFrom($this->data['from'])
            ->whereTo($this->data['to'])
                ->whereStart($this->data['start'])
            ->whereEnd($this->data['end'])->exists()
        ) {
            exit;
        }
    }
}
