<?php

namespace App\Filament\Resources\Scheduling;

use App\Filament\Resources\Scheduling;
use App\Models\Category;
use Exception;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-list';

    protected static ?string $navigationGroup = 'Infrastructure & Scheduling';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make(name: 'name')
                    ->required()
                    ->maxLength(length: 255)
                    ->columnSpan([
                        'md' => 12,
                    ]),
                Forms\Components\Textarea::make(name: 'note')
                    ->maxLength(length: 255)
                    ->columnSpan([
                        'md' => 12,
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
                Tables\Columns\TextColumn::make(name: 'name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(name: 'note')
                    ->default(state: 'NIL'),
                Tables\Columns\TextColumn::make(name: 'createdBy.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(name: 'created_at')
                    ->label(label: 'Created')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Scheduling\CategoryResource\Pages\ManageCategories::route('/'),
        ];
    }
}
