<?php

namespace App\States\Appointment;

class Pending extends AppointmentState
{

    public function color(): string
    {
        return 'orange';
    }

    public static string $name = 'pending';
}
