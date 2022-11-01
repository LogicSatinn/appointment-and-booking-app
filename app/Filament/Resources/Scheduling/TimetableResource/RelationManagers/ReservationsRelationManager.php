<?php

namespace App\Filament\Resources\Scheduling\TimetableResource\RelationManagers;

use App\Models\Reservation;
use App\States\Reservation\Pending;
use Exception;
use Filament\Forms\Components\Actions\Action;
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
use Filament\Tables\Contracts\HasRelationshipTable;
use Illuminate\Database\Eloquent\Model;

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
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),

                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique(),

                        TextInput::make('phone_number')
                            ->required()
                            ->unique()
                            ->rules(['starts_with:255']),

                        TextInput::make('address')
                            ->nullable(),
                    ])
                    ->createOptionAction(function (Action $action) {
                        return $action
                            ->modalHeading('Create Client')
                            ->modalButton('Create Client')
                            ->modalWidth('lg');
                    }),
                TextInput::make('no_of_seats')
                    ->label('Number of Seats')
                    ->numeric()
                    ->required(),
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
                    ->label('Client Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.email')
                    ->label('Client Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.phone_number')
                    ->label('Client Phone Number')
                    ->searchable(),
                TextColumn::make('reference_code')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'Pending',
                        'primary' => 'Reserved',
                        'success' => 'Booked',
                    ]),
                TextColumn::make('no_of_seats')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reserved_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (HasRelationshipTable $livewire, array $data): Model {
                        return $livewire->getRelationship()->create($data);
                    }),
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
