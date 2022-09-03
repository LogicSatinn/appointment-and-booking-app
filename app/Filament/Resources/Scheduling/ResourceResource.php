<?php

namespace App\Filament\Resources\Scheduling;

use App\Filament\Resources\Scheduling\ResourceResource\Pages\ManageResources;
use App\Models\Resource as ResourceModel;
use Exception;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
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
                TextInput::make('name')
                    ->required()
                    ->unique()
                    ->maxLength(255)
                    ->columnSpan([
                        'md' => 6,
                    ]),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->columnSpan([
                        'md' => 6,
                    ]),
                Textarea::make('note')
                    ->rows(3)
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
                TextColumn::make('name'),
                TextColumn::make('capacity'),
                IconColumn::make('state')
                    ->label('Availability')
                    ->options([
                        'heroicon-o-x-circle' => fn ($state): bool => $state == 'In Session',
                        'heroicon-o-check-circle' => fn ($state): bool => $state == 'Available',
                    ]),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('createdBy.name')
                    ->label('Created By'),
                TextColumn::make('updated_at')
                    ->label('Last Modified At')
                    ->dateTime(),
                TextColumn::make('lastModifiedBy.name')
                    ->label('Last Modified By')
                    ->default('N/A'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageResources::route('/'),
        ];
    }
}
