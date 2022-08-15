<?php

namespace App\Filament\Resources\SkillResource\RelationManagers;

use App\Enums\SkillLevel;
use Exception;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimetablesRelationManager extends RelationManager
{
    protected static string $relationship = 'timetables';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2) // Set the number of digits after the decimal point.
                        ->decimalSeparator() // Add a separator for decimal numbers.
                        ->mapToDecimalSeparator(['.']) // Map additional characters to the decimal separator.
                        ->minValue(1) // Set the minimum value that the number can be.
                        ->maxValue(1000000) // Set the maximum value that the number can be.
                        ->normalizeZeros() // Append or remove zeros at the end of the number.
                        ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                        ->thousandsSeparator() // Add a separator for thousands.
                    ),
                Forms\Components\Select::make('resource_id')
                    ->relationship('resource', 'name')
                    ->required()
                    ->label('Resource'),
                Forms\Components\Select::make('level')
                    ->options([
                        SkillLevel::BEGINNER->value => SkillLevel::BEGINNER->value,
                        SkillLevel::INTERMEDIATE->value => SkillLevel::INTERMEDIATE->value,
                        SkillLevel::ADVANCED->value => SkillLevel::ADVANCED->value,
                    ])
                    ->default(SkillLevel::BEGINNER->value)
                    ->required(),
                Forms\Components\DatePicker::make('from')
                    ->format('Y-m-d')
                    ->displayFormat('d/M/Y')
                    ->required(),
                Forms\Components\DatePicker::make('to')
                    ->format('Y-m-d')
                    ->displayFormat('d/M/Y')
                    ->required(),
                Forms\Components\TimePicker::make('start')
                    ->withoutSeconds()
                    ->required(),
                Forms\Components\TimePicker::make('end')
                    ->withoutSeconds()
                    ->required(),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->successNotificationMessage('New Timetable added.')
                    ->using(fn (Tables\Contracts\HasRelationshipTable $livewire, array $data): Model => $livewire->getRelationship()->create($data)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    /**
     * @throws Exception
     */
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
