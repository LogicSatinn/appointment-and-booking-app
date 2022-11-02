<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum BookingMethod: string
{
    use InvokableCases;

    case RESERVATION = 'Reservation';
    case DIRECT_PAYMENT = 'Direct Payment';
}
