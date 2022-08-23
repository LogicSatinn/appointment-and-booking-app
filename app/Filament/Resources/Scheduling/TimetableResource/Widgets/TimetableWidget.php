<?php

namespace App\Filament\Resources\Scheduling\TimetableResource\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class TimetableWidget extends FullCalendarWidget
{
    protected static string $view = 'filament.resources.timetable-resource.widgets.timetable-widget';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Breakfast!',
                'start' => now()
            ],
            [
                'id' => 2,
                'title' => 'Meeting with Pamela',
                'start' => now()->addDay(),
                'url' => 'https://some-url.com',
                'shouldOpenInNewTab' => true,
            ]
        ];
    }
}
