<?php

namespace App\Filament\Resources\TimetableResource\Widgets;

use App\Models\Timetable;
use Carbon\Carbon;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class TimetableWidget extends FullCalendarWidget
{
    protected static string $view = 'filament.resources.timetable-resource.widgets.timetable-widget';

    public function fetchEvent(array $fetchInfo): array
    {
        $data = Timetable::all('id', 'title', 'from', 'to')
            ->flatten(1)
            ->mapWithKeys(function ($items) {
                return [
                    'id' => $items['id'],
                    'title' => $items['title'],
                    'start' => Carbon::createFromDate($items['from'])->toDateTimeString(),
                    'end' => Carbon::createFromDate($items['to'])->toDateTimeString(),
                ];
            })
            ->toArray();

        return $data;
    }
}
