<?php

namespace App\States\Appointment;

class Complete extends AppointmentState
{

    public function color(): string
    {
        return 'green';
    }

    public static string $name = 'complete';
}
