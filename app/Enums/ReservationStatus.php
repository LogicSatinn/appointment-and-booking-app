<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case COMPLETE = 'Complete';
    case INCOMPLETE = 'Incomplete';
}
