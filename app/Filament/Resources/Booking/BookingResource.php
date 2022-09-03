<?php

namespace App\Filament\Resources\Booking;

use App\Enums\BookingMethod;
use App\Filament\Resources\Booking\BookingResource\Pages\EditBooking;
use App\Filament\Resources\Booking\BookingResource\Pages\ListBookings;
use App\Models\Booking;
use App\States\Booking\Failed;
use App\States\Booking\Paid;
use Exception;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
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

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Booking & Client Interaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
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
                            ])->columns(),

                        Card::make()
                            ->schema([
                                Select::make('reservation_id')
                                    ->relationship('reservation', 'reference_code')
                                    ->disabled(),

                                TextInput::make('reference_code')
                                    ->rules(['starts_with:NL-B'])
                                    ->required(),

                                Select::make('status')
                                    ->options([
                                        'Pending' => 'Pending',
                                        'Paid' => 'Paid',
                                        'Failed' => 'Failed',
                                    ])
                                    ->disablePlaceholderSelection()
                                    ->required(),

                                Select::make('booking_method')
                                    ->options([
                                        BookingMethod::DIRECT_PAYMENT->value => 'Direct Payment',
                                        BookingMethod::RESERVATION->value => 'Reservation',
                                    ])
                                    ->disablePlaceholderSelection()
                                    ->required(),
                            ])->columns(),
                    ]),

                Section::make('Payment Details')
                    ->schema([
                        TextInput::make('total_amount')
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
                        TextInput::make('paid_amount')
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
                        TextInput::make('due_amount')
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
                    ])->columns(),
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
                    ->sortable()
                    ->searchable(),
                TextColumn::make('timetable.title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reservation.reference_code')
                    ->label('Reservation')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reference_code')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('status')->icons([
                    'heroicon-o-clock' => 'Pending',
                    'heroicon-o-check' => 'Paid',
                    'heroicon-o-x' => 'Failed',
                ]),
                TextColumn::make('total_amount')
                    ->formatStateUsing(fn (string $state, Booking $record): string => $record->representablePrice($record->total_amount))
                    ->sortable(),
                TextColumn::make('paid_amount')
                    ->formatStateUsing(fn (string $state, Booking $record): string => $record->representablePrice($record->paid_amount))
                    ->sortable(),
                TextColumn::make('due_amount')
                    ->formatStateUsing(fn (string $state, Booking $record): string => $record->representablePrice($record->due_amount))
                    ->sortable(),
                TextColumn::make('booked_at'),
                TextColumn::make('booking_method')
                    ->default('N/A')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
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
            'index' => ListBookings::route('/'),
            'edit' => EditBooking::route('/{record}/edit'),
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
        return static::$model::whereState('status', Paid::class)->orWhereState('status', Failed::class)->count();
    }
}
