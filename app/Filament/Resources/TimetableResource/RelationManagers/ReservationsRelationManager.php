<?php

namespace App\Filament\Resources\TimetableResource\RelationManagers;

use App\States\Reservation\Pending;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class ReservationsRelationManager extends RelationManager
{
    protected static string $relationship = 'reservations';

    protected static ?string $recordTitleAttribute = 'reference_code';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('booking_id')
                    ->relationship('booking', 'reference_code')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('reference_code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('seat_number')
                    ->numeric()
                    ->required(),
                DatePicker::make('reserved_at')
                    ->default(now())
                    ->required()
                    ->disabled(),
                TextInput::make('status')
                    ->default(Pending::$name)
                    ->disabled()
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
                TextColumn::make('client.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('booking.reference_code')
                    ->label('Booking Reference')
                    ->searchable(),
                TextColumn::make('reference_code')
                    ->searchable(),
                BadgeColumn::make('status')
                ->colors([
                    'warning' => 'Pending',
                    'primary' => 'Reserved',
                    'success' => 'Booked',
                ]),
                TextColumn::make('seat_number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reserved_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
