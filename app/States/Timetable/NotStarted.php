<?php

namespace App\States\Timetable;

class NotStarted extends TimetableState
{
    public function color(): string
    {
        return 'orange';
    }

    public static string $name = 'Not Started';
}
