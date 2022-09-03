<?php

namespace App\Filament\Resources\Booking\ReservationResource\Pages;

use App\Filament\Resources\Booking\ReservationResource;
use App\Filament\Widgets\ReservationsOverview;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ReservationsOverview::class,
        ];
    }
}
