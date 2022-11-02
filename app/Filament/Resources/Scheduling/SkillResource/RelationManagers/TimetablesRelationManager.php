<?php

namespace App\Filament\Resources\Scheduling\SkillResource\RelationManagers;

use App\Enums\SkillLevel;
use App\Jobs\DispatchNotificationsUponTimetableDeletion;
use App\Models\Timetable;
use Carbon\Carbon;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimetablesRelationManager extends RelationManager
{
    protected static string $relationship = 'timetables';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(name: 'title')
                    ->required()
                    ->maxLength(length: 255),
                TextInput::make(name: 'price')
                    ->required()
                    ->numeric()
                    ->mask(fn(TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(places: 2) // Set the number of digits after the decimal point.
                        ->decimalSeparator() // Add a separator for decimal numbers.
                        ->mapToDecimalSeparator(characters: ['.']) // Map additional characters to the decimal separator.
                        ->minValue(value: 1) // Set the minimum value that the number can be.
                        ->maxValue(value: 1000000) // Set the maximum value that the number can be.
                        ->normalizeZeros() // Append or remove zeros at the end of the number.
                        ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                        ->thousandsSeparator() // Add a separator for thousands.
                    ),
                Select::make(name: 'resource_id')
                    ->relationship(relationshipName: 'resource', titleColumnName: 'name')
                    ->required()
                    ->searchable()
                    ->disablePlaceholderSelection()
                    ->label(label: 'Resource'),
                Select::make(name: 'level')
                    ->options([
                        SkillLevel::BEGINNER->value => SkillLevel::BEGINNER->value,
                        SkillLevel::INTERMEDIATE->value => SkillLevel::INTERMEDIATE->value,
                        SkillLevel::ADVANCED->value => SkillLevel::ADVANCED->value,
                    ])
                    ->disablePlaceholderSelection()
                    ->default(state: SkillLevel::BEGINNER->value)
                    ->required(),
                DatePicker::make(name: 'from')
                    ->after(date: today()->addDay())
                    ->minDate(date: today()->addDay())
                    ->reactive()
                    ->required(),
                DatePicker::make(name: 'to')
                    ->after(today())
                    ->minDate(date: function (callable $get) {
                        if (! $get('from')) {
                            return today()->addDay();
                        }

                        return Carbon::parse($get('from'))->addDay();
                    })
                    ->required(),
                TimePicker::make(name: 'start')
                    ->withoutSeconds()
                    ->required(),
                TimePicker::make(name: 'end')
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
                TextColumn::make(name: 'title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make(name: 'price')
                    ->formatStateUsing(fn(string $state, Timetable $record): string => $record->representablePrice())
                    ->sortable(),
                TextColumn::make(name: 'resource.name'),
                BadgeColumn::make(name: 'level')
                    ->colors([
                        'success' => 'Beginner',
                        'primary' => 'Intermediate',
                        'warning' => 'Advanced',
                    ]),
                TextColumn::make(name: 'from')->date()
                    ->sortable()
                    ->searchable(),
                TextColumn::make(name: 'to')->date()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make(name: 'delete')
                        ->color(color: 'danger')
                        ->icon(icon: 'heroicon-s-trash')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            if ($record->reservations()->count() > 0 && $record->status == 'Complete') {
                                DispatchNotificationsUponTimetableDeletion::dispatch($record);
                            }
                            $record->delete();
                        }),
                    ForceDeleteAction::make(),
                    RestoreAction::make(),
                ])
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                RestoreBulkAction::make(),
                ForceDeleteBulkAction::make(),
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
