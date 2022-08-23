<?php

namespace App\Filament\Resources\Booking\ReservationResource\Pages;

use App\Filament\Resources\Booking\ReservationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
