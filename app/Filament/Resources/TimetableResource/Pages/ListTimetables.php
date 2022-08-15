<?php

namespace App\Filament\Resources\TimetableResource\Pages;

use App\Filament\Resources\TimetableResource;
use App\Filament\Resources\TimetableResource\Widgets\TimetableWidget;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimetables extends ListRecords
{
    protected static string $resource = TimetableResource::class;

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
            TimetableWidget::class,
        ];
    }
}
