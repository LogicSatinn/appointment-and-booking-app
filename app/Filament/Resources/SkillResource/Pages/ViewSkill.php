<?php

namespace App\Filament\Resources\SkillResource\Pages;

use App\Filament\Resources\SkillResource;
use App\States\Skill\Archived;
use App\States\Skill\Published;
use Exception;
use Filament\Forms;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewSkill extends ViewRecord
{
    protected static string $resource = SkillResource::class;

    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('Update Status')
                ->action(function (array $data): void {
                    match (true) {
                        $data['status'] == 'Archive' => $this->record->update(['status' => Archived::class]),
                        $data['status'] == 'Publish' => $this->record->update(['status' => Published::class])
                    };
                    $this->emit('refreshComponent');
                })
                ->form([
                    Forms\Components\Select::make('status')
                        ->options([
                            'Archive' => 'Archive',
                            'Publish' => 'Publish',
                        ])
                        ->default('Archive')
                        ->required(),
                ]),
            Actions\DeleteAction::make(),
        ];
    }
}
