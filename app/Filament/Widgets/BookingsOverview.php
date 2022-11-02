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
                label: 'Total Bookings',
                value: Booking::count()),
            Card::make(
                label: 'Paid Bookings',
                value: Booking::whereState('status', Paid::class)->count())
                ->color('success')
                ->descriptionIcon('heroicon-s-check'),
            Card::make(
                label: 'Failed Bookings',
                value: Booking::whereState('status', Failed::class)->count())
                ->color('danger')
                ->descriptionIcon('heroicon-s-x'),
        ];
    }
}
