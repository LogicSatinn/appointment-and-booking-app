<?php

namespace App\States\Timetable;

class Complete extends TimetableState
{

    public function color(): string
    {
        return 'green';
    }

    public static string $name = 'Complete';
}
