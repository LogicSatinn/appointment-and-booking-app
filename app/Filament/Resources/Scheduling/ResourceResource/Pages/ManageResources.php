<?php

namespace App\Filament\Resources\Scheduling\ResourceResource\Pages;

use App\Filament\Resources\Scheduling\ResourceResource;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageResources extends ManageRecords
{
    protected static string $resource = ResourceResource::class;

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
