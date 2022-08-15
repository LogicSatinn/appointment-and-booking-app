<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimetableResource\Pages;
use App\Filament\Resources\TimetableResource\RelationManagers\BookingsRelationManager;
use App\Filament\Resources\TimetableResource\RelationManagers\ClientsRelationManager;
use App\Filament\Resources\TimetableResource\RelationManagers\ReservationsRelationManager;
use App\Filament\Resources\TimetableResource\Widgets\TimetableWidget;
use App\Models\Timetable;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
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

class TimetableResource extends Resource
{
    protected static ?string $model = Timetable::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('resource_id')
                    ->relationship('resource', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('skill_id')
                    ->relationship('skill', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('level')
                    ->required()
                    ->maxLength(255),
                TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('from')
                    ->required(),
                DatePicker::make('to')
                    ->required(),
                TextInput::make('start')
                    ->required(),
                TextInput::make('end')
                    ->required(),
                TextInput::make('price')
                    ->mask(fn (TextInput\Mask $mask) => $mask
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
            ]);
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
                TextColumn::make('price'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
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
            ClientsRelationManager::class,
            BookingsRelationManager::class,
            ReservationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimetables::route('/'),
            'create' => Pages\CreateTimetable::route('/create'),
            'view' => Pages\ViewTimetable::route('/{record}'),
            'edit' => Pages\EditTimetable::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            TimetableWidget::class,
        ];
    }
}
