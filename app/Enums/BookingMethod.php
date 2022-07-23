<?php

namespace App\Enums;

enum BookingMethod: string
{
    case RESERVATION = 'Reservation';
    case DIRECT_PAYMENT = 'Direct Payment';
}
