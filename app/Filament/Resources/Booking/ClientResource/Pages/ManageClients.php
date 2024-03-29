<?php

namespace App\Filament\Resources\Booking\ClientResource\Pages;

use App\Filament\Resources\Booking\ClientResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageClients extends ManageRecords
{
    protected static string $resource = ClientResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
