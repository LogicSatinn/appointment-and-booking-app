<?php

namespace App\Filament\Resources\Scheduling;

use App\Enums\SkillLevel;
use App\Filament\Resources\Scheduling;
use App\Filament\Resources\Scheduling\TimetableResource\RelationManagers\BookingsRelationManager;
use App\Filament\Resources\Scheduling\TimetableResource\RelationManagers\ReservationsRelationManager;
use App\Jobs\DispatchNotificationsUponTimetableDeletion;
use App\Models\Timetable;
use App\Rules\CheckForAllocatedResourceRule;
use Exception;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TimetableResource extends Resource
{
    protected static ?string $model = Timetable::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Timetable';

    protected static ?string $navigationGroup = 'Infrastructure & Scheduling';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                Select::make('skill_id')
                                    ->relationship('skill', 'title')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('title')
                                    ->required()
                                    ->lazy()
                                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug(Str::lower($state))) : null)
                                    ->maxLength(255),

                                TextInput::make('slug')
                                    ->disabled()
                                    ->required()
                                    ->unique(Timetable::class, 'slug', ignoreRecord: true),

                                Select::make('level')
                                    ->options([
                                        SkillLevel::BEGINNER->value => SkillLevel::BEGINNER->value,
                                        SkillLevel::INTERMEDIATE->value => SkillLevel::INTERMEDIATE->value,
                                        SkillLevel::ADVANCED->value => SkillLevel::ADVANCED->value,
                                    ])
                                    ->disablePlaceholderSelection()
                                    ->required(),

                                TextInput::make('price')
                                    ->mask(fn(TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                        ->decimalSeparator() // Add a separator for decimal numbers.
                                        ->mapToDecimalSeparator(['.']) // Map additional characters to the decimal separator.
                                        ->minValue(1) // Set the minimum value that the number can be.
                                        ->normalizeZeros() // Append or remove zeros at the end of the number.
                                        ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                        ->thousandsSeparator() // Add a separator for thousands.
                                    )
                                    ->required(),

                                Select::make('resource_id')
                                    ->relationship('resource', 'name')
                                    ->searchable()
                                    ->rules([new CheckForAllocatedResourceRule()])
                                    ->preload()
                                    ->required(),
                            ])
                            ->columns(),

                        Section::make('Schedule')
                            ->schema([
                                DatePicker::make('from')
                                    ->after(today())
                                    ->required(),
                                DatePicker::make('to')
                                    ->after(today())
                                    ->required(),
                                TimePicker::make('start')
                                    ->withoutSeconds()
                                    ->required(),
                                TimePicker::make('end')
                                    ->withoutSeconds()
                                    ->required(),
                            ])->columns(),
                    ])
                    ->columnSpan(['lg' => 3]),
            ])
            ->columns(3);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('skill.title'),
                TextColumn::make('resource.name')->label('Resource Used'),
                TextColumn::make('title'),
                BadgeColumn::make('level')
                    ->colors([
                        'success' => 'Beginner',
                        'primary' => 'Intermediate',
                        'warning' => 'Advanced',
                    ]),
                BadgeColumn::make('status')
                    ->icons([
                        'heroicon-o-bell' => 'Not Started',
                        'heroicon-o-microphone' => 'Ongoing',
                        'heroicon-o-badge-check' => 'Completed',
                    ])->iconPosition('after'),
                TextColumn::make('from')
                    ->date(),
                TextColumn::make('to')
                    ->date(),
                TextColumn::make('start'),
                TextColumn::make('end'),
                TextColumn::make('price')
                    ->formatStateUsing(fn(string $state, Timetable $record): string => $record->representablePrice())
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('delete')
                    ->icon('heroicon-s-trash')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        if ($record->reservations()->count() > 0 && $record->status == 'Complete') {
                            DispatchNotificationsUponTimetableDeletion::dispatch($record);
                        }
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                RestoreBulkAction::make(),
                ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ReservationsRelationManager::class,
            BookingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Scheduling\TimetableResource\Pages\ListTimetables::route('/'),
            'create' => Scheduling\TimetableResource\Pages\CreateTimetable::route('/create'),
            'view' => Scheduling\TimetableResource\Pages\ViewTimetable::route('/{record}'),
            'edit' => Scheduling\TimetableResource\Pages\EditTimetable::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
