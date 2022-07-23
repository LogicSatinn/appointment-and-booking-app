<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case RESERVED = 'Reserved';
    case BOOKED = 'Booked';
    case PENDING = 'Pending';
}
