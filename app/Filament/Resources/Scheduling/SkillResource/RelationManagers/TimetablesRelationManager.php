<?php

namespace App\Filament\Resources\Scheduling\SkillResource\RelationManagers;

use App\Enums\SkillLevel;
use App\Jobs\DispatchNotificationsUponTimetableDeletion;
use App\Models\Timetable;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimetablesRelationManager extends RelationManager
{
    protected static string $relationship = 'timetables';

//    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
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
                Select::make('resource_id')
                    ->relationship('resource', 'name')
                    ->required()
                    ->searchable()
                    ->disablePlaceholderSelection()
                    ->label('Resource'),
                Select::make('level')
                    ->options([
                        SkillLevel::BEGINNER->value => SkillLevel::BEGINNER->value,
                        SkillLevel::INTERMEDIATE->value => SkillLevel::INTERMEDIATE->value,
                        SkillLevel::ADVANCED->value => SkillLevel::ADVANCED->value,
                    ])
                    ->disablePlaceholderSelection()
                    ->default(SkillLevel::BEGINNER->value)
                    ->required(),
                DatePicker::make('from')
                    ->format('Y-m-d')
                    ->displayFormat('d/M/Y')
                    ->required(),
                DatePicker::make('to')
                    ->format('Y-m-d')
                    ->displayFormat('d/M/Y')
                    ->required(),
                TimePicker::make('start')
                    ->withoutSeconds()
                    ->required(),
                TimePicker::make('end')
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
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->formatStateUsing(fn (string $state, Timetable $record): string => $record->representablePrice())
                    ->sortable(),
                TextColumn::make('resource.name'),
                BadgeColumn::make('level')
                    ->colors([
                        'success' => 'Beginner',
                        'primary' => 'Intermediate',
                        'warning' => 'Advanced',
                    ]),
                TextColumn::make('from')->date()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('to')->date()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                //                Tables\Actions\CreateAction::make()
                //                    ->successNotificationMessage('New Timetable added.')
                //                    ->using(fn(HasRelationshipTable $livewire, array $data): Model => $livewire->getRelationship()->create($data)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('delete')
                    ->icon('heroicon-s-trash')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        if ($record->reservations()->count() > 0 && $record->status == 'Complete') {
                            DispatchNotificationsUponTimetableDeletion::dispatch($record);
                        }
                        $record->delete();
                    }),
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
