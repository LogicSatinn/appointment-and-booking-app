<?php

namespace App\Filament\Resources\Scheduling;

use App\Enums\SkillLevel;
use App\Filament\Resources\Scheduling\TimetableResource\Pages\CreateTimetable;
use App\Filament\Resources\Scheduling\TimetableResource\Pages\EditTimetable;
use App\Filament\Resources\Scheduling\TimetableResource\Pages\ListTimetables;
use App\Filament\Resources\Scheduling\TimetableResource\Pages\ViewTimetable;
use App\Filament\Resources\Scheduling\TimetableResource\RelationManagers\BookingsRelationManager;
use App\Filament\Resources\Scheduling\TimetableResource\RelationManagers\ReservationsRelationManager;
use App\Jobs\DispatchNotificationsUponTimetableDeletion;
use App\Models\Timetable;
use App\Rules\CheckForAllocatedResourceRule;
use App\States\Timetable\Complete;
use App\States\Timetable\NotStarted;
use App\States\Timetable\OnGoing;
use Carbon\Carbon;
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
use Filament\Tables\Actions\ActionGroup;
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
                                Select::make(name: 'skill_id')
                                    ->relationship(relationshipName: 'skill', titleColumnName: 'title')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make(name: 'title')
                                    ->required()
                                    ->lazy()
                                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug(Str::lower($state))) : null)
                                    ->maxLength(length: 255),

                                TextInput::make(name: 'slug')
                                    ->disabled()
                                    ->required()
                                    ->unique(table: Timetable::class, column: 'slug', ignoreRecord: true),

                                Select::make(name: 'level')
                                    ->options(options: [
                                        SkillLevel::BEGINNER->value => SkillLevel::BEGINNER->value,
                                        SkillLevel::INTERMEDIATE->value => SkillLevel::INTERMEDIATE->value,
                                        SkillLevel::ADVANCED->value => SkillLevel::ADVANCED->value,
                                    ])
                                    ->required(),

                                TextInput::make(name: 'price')
                                    ->mask(fn(TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(places: 2) // Set the number of digits after the decimal point.
                                        ->decimalSeparator() // Add a separator for decimal numbers.
                                        ->mapToDecimalSeparator(['.']) // Map additional characters to the decimal separator.
                                        ->minValue(value: 1) // Set the minimum value that the number can be.
                                        ->normalizeZeros() // Append or remove zeros at the end of the number.
                                        ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                        ->thousandsSeparator() // Add a separator for thousands.
                                    )
                                    ->required(),

                                Select::make(name: 'resource_id')
                                    ->relationship(relationshipName: 'resource', titleColumnName: 'name')
                                    ->searchable()
                                    ->rules(rules: [new CheckForAllocatedResourceRule()])
                                    ->preload()
                                    ->required(),
                            ])
                            ->columns(),

                        Section::make(heading: 'Schedule')
                            ->schema([
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
                            ])->columns(),
                    ])
                    ->columnSpan(span: ['lg' => 3]),
            ])
            ->columns(columns: 3);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(name: 'skill.title')
                    ->label(label: 'Skill Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make(name: 'resource.name')
                    ->label(label: 'Resource Used')
                    ->sortable(),
                TextColumn::make(name: 'title')
                    ->label(label: 'Timetable Title')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make(name: 'level')
                    ->colors(colors: [
                        'success' => 'Beginner',
                        'primary' => 'Intermediate',
                        'warning' => 'Advanced',
                    ]),
                BadgeColumn::make(name: 'status')
                    ->icons(icons: [
                        'heroicon-o-bell' => static fn($state) => $state->equals(NotStarted::class),
                        'heroicon-o-microphone' => static fn($state) => $state->equals(OnGoing::class),
                        'heroicon-o-badge-check' => static fn($state) => $state->equals(Complete::class),
                    ])->iconPosition(iconPosition: 'after'),
                TextColumn::make(name: 'from')
                    ->date(),
                TextColumn::make(name: 'to')
                    ->date(),
                TextColumn::make(name: 'start'),
                TextColumn::make(name: 'end'),
                TextColumn::make(name: 'price')
                    ->formatStateUsing(fn(string $state, Timetable $record): string => $record->representablePrice())
                    ->sortable(),
                TextColumn::make(name: 'created_at')
                    ->label(label: 'Created')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make(name: 'delete')
                        ->icon(icon: 'heroicon-s-trash')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            if ($record->reservations->isNotEmpty() && $record->status->equals(Complete::class)) {
                                DispatchNotificationsUponTimetableDeletion::dispatch($record);
                            }

                            $record->delete();
                        }),
                ])
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
            'index' => ListTimetables::route(path: '/'),
            'create' => CreateTimetable::route(path: '/create'),
            'view' => ViewTimetable::route(path: '/{record}'),
            'edit' => EditTimetable::route(path: '/{record}/edit'),
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
