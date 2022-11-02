<?php

namespace App\Filament\Resources\Scheduling;

use App\Filament\Resources\Scheduling\ResourceResource\Pages\ManageResources;
use App\Models\Resource as ResourceModel;
use Exception;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Infrastructure & Scheduling';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(name: 'name')
                    ->required()
                    ->unique()
                    ->maxLength(length: 255)
                    ->columnSpan([
                        'md' => 6,
                    ]),
                TextInput::make(name: 'capacity')
                    ->required()
                    ->numeric()
                    ->columnSpan([
                        'md' => 6,
                    ]),
                Textarea::make(name: 'note')
                    ->rows(rows: 3)
                    ->columnSpan([
                        'md' => 12,
                    ]),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(name: 'name'),
                TextColumn::make(name: 'capacity'),
                IconColumn::make(name: 'state')
                    ->label(label: 'Availability')
                    ->options([
                        'heroicon-o-x-circle' => fn ($state): bool => $state == 'In Session',
                        'heroicon-o-check-circle' => fn ($state): bool => $state == 'Available',
                    ]),
                TextColumn::make(name: 'createdBy.name')
                    ->label(label: 'Created By'),
                TextColumn::make(name: 'lastModifiedBy.name')
                    ->label(label: 'Last Modified By')
                    ->default(state: 'N/A'),
                TextColumn::make(name: 'created_at')
                    ->label(label: 'Created')
                    ->since(),
                TextColumn::make(name: 'updated_at')
                    ->label(label: 'Last Modified')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageResources::route('/'),
        ];
    }
}
