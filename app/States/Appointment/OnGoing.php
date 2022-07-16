<?php

namespace App\States\Appointment;

class OnGoing extends AppointmentState
{

    public function color(): string
    {
        return 'grey';
    }

    public static string $name = 'ongoing';
}
