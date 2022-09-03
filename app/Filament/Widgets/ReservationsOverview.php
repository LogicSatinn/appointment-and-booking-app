<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use App\States\Reservation\Booked;
use App\States\Reservation\Reserved;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ReservationsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make(
                'Total Reservations',
                Reservation::count()),
            Card::make(
                'Reserved Reservations',
                Reservation::whereState('status', Reserved::class)->count())
                ->color('success')
                ->descriptionIcon('heroicon-s-check'),
            Card::make(
                'Booked Reservations',
                Reservation::whereState('status', Booked::class)->count())
                ->color('primary')
                ->descriptionIcon('heroicon-s-x'),
        ];
    }
}
