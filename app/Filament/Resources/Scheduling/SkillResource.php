<?php

namespace App\Filament\Resources\Scheduling;

use App\Filament\Resources\Scheduling;
use App\Filament\Resources\Scheduling\SkillResource\Pages\CreateSkill;
use App\Filament\Resources\Scheduling\SkillResource\Pages\EditSkill;
use App\Filament\Resources\Scheduling\SkillResource\Pages\ListSkills;
use App\Filament\Resources\Scheduling\SkillResource\Pages\ViewSkill;
use App\Filament\Resources\Scheduling\SkillResource\RelationManagers\TimetablesRelationManager;
use App\Models\Skill;
use App\States\Skill\Archived;
use App\States\Skill\Draft;
use App\States\Skill\Published;
use Exception;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
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
use Illuminate\Support\Str;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationGroup = 'Infrastructure & Scheduling';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make(heading: 'Images')
                            ->schema([
                                FileUpload::make(name: 'image_path')->required(static fn(Page $livewire): bool => $livewire instanceof Scheduling\SkillResource\Pages\CreateSkill)
                                    ->preserveFilenames()
                                    ->directory(directory: 'skill_covers')
                                    ->image()
                                    ->disableLabel(),
                            ])
                            ->collapsible(),
                    ])
                    ->columnSpan(['lg' => 12]),

                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make(name: 'title')
                                    ->required()
                                    ->lazy()
                                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug(Str::lower($state))) : null),

                                Select::make(name: 'category_id')
                                    ->relationship(relationshipName: 'category', titleColumnName: 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make(name: 'slug')
                                    ->disabled()
                                    ->required()
                                    ->unique(table: Skill::class, column: 'slug', ignoreRecord: true),

                                Select::make(name: 'status')
                                    ->options(options: [
                                        Archived::$name => 'Archive',
                                        Published::$name => 'Publish',
                                    ])
                                    ->disablePlaceholderSelection()
                                    ->reactive()
                                    ->visibleOn(contexts: 'edit'),

                            ])
                            ->columns(),

                        Section::make(heading: 'More Information')
                            ->schema(components: [
                                RichEditor::make(name: 'description')
                                    ->columnSpan(span: 'full')
                                    ->required()
                                    ->toolbarButtons(buttons: [
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
                                    ]),

                                RichEditor::make(name: 'mode_of_delivery')
                                    ->required()
                                    ->toolbarButtons(buttons: [
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
                                    ]),

                                RichEditor::make(name: 'prerequisite')
                                    ->required()
                                    ->toolbarButtons(buttons: [
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
                                    ]),

                                RichEditor::make(name: 'suitable_for')
                                    ->required()
                                    ->toolbarButtons(buttons: [
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
                                    ]),
                            ])
                            ->columns(columns: 1),
                    ])->columnSpan(span: ['lg' => 12]),

            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make(name: 'image_path')
                    ->rounded()
                    ->label(label: 'Cover Photo'),
                TextColumn::make(name: 'title')
                    ->searchable()
                    ->sortable()
                    ->limit(length: 20),
                TextColumn::make(name: 'category.name')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make(name: 'status')
                    ->icons([
                        'heroicon-o-document' => static fn($state) => $state->equals(Draft::class),
                        'heroicon-o-archive' => static fn($state) => $state->equals(Archived::class),
                        'heroicon-o-truck' => static fn($state) => $state->equals(Published::class),
                    ])->iconPosition('after'),
                TextColumn::make(name: 'created_at')
                    ->label(label: 'Created')
                    ->since(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make(actions: [
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make(name: 'updateStatus')
                        ->label(label: 'Update Status')
                        ->mountUsing(fn(ComponentContainer $form, Skill $record) => $form->fill([
                            'status' => $record->status,
                        ]))
                        ->action(function (Skill $record, array $data): void {
                            $record->status->transitionTo($data['status']);
                            $record->save();
                        })
                        ->form([
                            Select::make(name: 'status')
                                ->label(label: 'Update Status')
                                ->options(options: [
                                    Archived::class => Archived::$name,
                                    Published::class => Published::$name,
                                ])
                                ->required(),
                        ])
                        ->icon(icon: 'heroicon-s-adjustments'),
                    DeleteAction::make(),
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
            TimetablesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSkills::route(path: '/'),
            'create' => CreateSkill::route(path: '/create'),
            'view' => ViewSkill::route(path: '/{record}'),
            'edit' => EditSkill::route(path: '/{record}/edit'),
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
        return static::$model::whereState('status', Published::class)->count();
    }
}
