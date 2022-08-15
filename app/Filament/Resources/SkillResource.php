<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Filament\Resources\SkillResource\RelationManagers\TimetablesRelationManager;
use App\Models\Skill;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image_path')
                    ->required(static fn (Page $livewire): bool => $livewire instanceof Pages\CreateSkill)
                    ->preserveFilenames()
                    ->directory('skill_covers')
                    ->image()
                    ->label(static fn (Page $livewire): string => $livewire instanceof Pages\EditSkill ? 'Change Cover Photo' : 'Cover Photo')
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                RichEditor::make('description')
                    ->required()
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'undo',
                    ])
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
                RichEditor::make('mode_of_delivery')
                    ->required()
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'undo',
                    ])
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
                RichEditor::make('prerequisite')
                    ->required()
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'undo',
                    ])
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
                RichEditor::make('suitable_for')
                    ->required()
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'undo',
                    ])
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
                TextInput::make('status')
                    ->visibleOn('view'),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')->rounded()->label('Cover Photo'),
                TextColumn::make('title')->limit(20),
                TextColumn::make('category.name'),
                TextColumn::make('status'),
                BadgeColumn::make('status')
                    ->icons([
                        'heroicon-o-document' => 'Draft',
                        'heroicon-o-archive' => 'Archived',
                        'heroicon-o-truck' => 'Published',
                    ])->iconPosition('after'),
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
            TimetablesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'view' => Pages\ViewSkill::route('/{record}'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
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
