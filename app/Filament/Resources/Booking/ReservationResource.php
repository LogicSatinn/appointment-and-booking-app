<?php

namespace App\Filament\Resources\Booking;

use App\Filament\Resources\Booking;
use App\Models\Reservation;
use App\States\Reservation\Booked;
use App\States\Reservation\Reserved;
use Exception;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Booking & Client Interaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()
                    ->schema([
                        Select::make('client_id')
                            ->relationship('client', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('timetable_id')
                            ->relationship('timetable', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('no_of_seats')
                            ->label('Number of Seats')
                            ->required(),

                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Booked' => 'Booked',
                                'Reserved' => 'Reserved',
                            ])
                            ->disablePlaceholderSelection()
                            ->required(),

                        DateTimePicker::make('reserved_at')
                            ->default(now())
                            ->disabled()
                            ->required(),
                    ])
                    ->columns(),
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
                TextColumn::make('client.email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.phone_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('timetable.title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reference_code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('no_of_seats')
                    ->label('Number of Seats'),
                BadgeColumn::make('status')->colors([
                    'warning' => 'Pending',
                    'success' => 'Booked',
                    'primary' => 'Reserved',
                ]),
                TextColumn::make('reserved_at'),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->label('Last Modified At')
                    ->dateTime(),
                TextColumn::make('lastModifiedBy.name')
                    ->label('Last Modified By')
                    ->default('N/A'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Booking\ReservationResource\Pages\ListReservations::route('/'),
            'create' => Booking\ReservationResource\Pages\CreateReservation::route('/create'),
            'edit' => Booking\ReservationResource\Pages\EditReservation::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::$model::whereState('status', Reserved::class)->orWhereState('status', Booked::class)->count();
    }
}
