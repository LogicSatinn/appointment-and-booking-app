<?php

namespace App\Filament\Resources\Scheduling\SkillResource\Pages;

use App\Filament\Resources\Scheduling\SkillResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSkill extends CreateRecord
{
    protected static string $resource = SkillResource::class;

    /**
     * @param  array  $data
     * @return array
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return array_merge(
            $data,
            ['slug' => $data['title']]
        );
    }
}
