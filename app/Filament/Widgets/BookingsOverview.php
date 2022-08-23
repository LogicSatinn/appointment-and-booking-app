<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\States\Booking\Failed;
use App\States\Booking\Paid;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class BookingsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make(
                'Total Bookings',
                Booking::count()),
            Card::make(
                'Paid Bookings',
                Booking::whereState('status', Paid::class)->count())
                ->color('success')
                ->descriptionIcon('heroicon-s-check'),
            Card::make(
                'Failed Bookings',
                Booking::whereState('status', Failed::class)->count())
                ->color('danger')
                ->descriptionIcon('heroicon-s-x')
        ];
    }
}
