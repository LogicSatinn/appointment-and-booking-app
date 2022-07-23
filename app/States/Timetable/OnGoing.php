<?php

namespace App\States\Timetable;

class OnGoing extends TimetableState
{

    public function color(): string
    {
        return 'grey';
    }

    public static string $name = 'Ongoing';
}
