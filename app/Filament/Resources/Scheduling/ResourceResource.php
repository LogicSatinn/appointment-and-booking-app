<?php

namespace App\Filament\Resources\Scheduling;

use App\Filament\Resources\Scheduling\ResourceResource\Pages;
use App\Filament\Resources\Scheduling;
use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Infrastructure & Scheduling';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan([
                        'md' => 6,
                    ]),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->maxLength(255)
                    ->columnSpan([
                        'md' => 6,
                    ]),
                Forms\Components\Textarea::make('note')
                    ->rows(3)
                    ->columnSpan([
                        'md' => 12,
                    ]),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('capacity'),
                Tables\Columns\TextColumn::make('state'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Scheduling\ResourceResource\Pages\ManageResources::route('/'),
        ];
    }
}
