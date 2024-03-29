<?php

namespace App\Filament\Resources\Scheduling\TimetableResource\RelationManagers;

use App\Enums\BookingMethod;
use App\Models\Booking;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';

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
                Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Paid' => 'Paid',
                        'Failed',
                    ])
                    ->required(),
                Select::make('booking_method')
                    ->options([
                        BookingMethod::DIRECT_PAYMENT->value => BookingMethod::DIRECT_PAYMENT->value,
                        BookingMethod::RESERVATION->value => BookingMethod::RESERVATION->value,
                    ]),
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
                TextColumn::make('reference_code')
                    ->tooltip('Reference Code')
                    ->searchable(),
                BadgeColumn::make('status')
                    ->icons([
                        'heroicon-o-clock' => 'Pending',
                        'heroicon-o-check' => 'Paid',
                        'heroicon-o-x' => 'Failed',
                    ])->iconPosition('after'),
                TextColumn::make('total_amount')
                    ->formatStateUsing(fn (string $state, Booking $record): string => $record->representablePrice($record->total_amount))
                    ->sortable(),
                TextColumn::make('paid_amount')
                    ->formatStateUsing(fn (string $state, Booking $record): string => $record->representablePrice($record->paid_amount))
                    ->sortable(),
                TextColumn::make('due_amount')
                    ->formatStateUsing(fn (string $state, Booking $record): string => $record->representablePrice($record->due_amount))
                    ->sortable(),
                TextColumn::make('booking_method')->default('N/A'),
                TextColumn::make('booked_at')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //                CreateAction::make(),
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
