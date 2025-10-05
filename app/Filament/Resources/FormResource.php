<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Filament\Resources\FormResource\RelationManagers;
use App\Models\Form;
use App\Models\FormField;
use Filament\Forms;
use Filament\Forms\Form as FilamentForm;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use App\Filament\Exports\FormSubmissionExporter;
use Filament\Actions\Exports\Enums\ExportFormat;
use Illuminate\Support\Str;

class FormResource extends Resource
{
    protected static ?string $model = Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Form Builder';
    
    protected static ?int $navigationSort = 1;

    public static function form(FilamentForm $form): FilamentForm
    {
        return $form
            ->schema([
                Section::make('Form Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $context, $state, Forms\Set $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                                
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Form::class, 'slug', ignoreRecord: true)
                                    ->rules(['alpha_dash']),
                            ]),
                        
                        Textarea::make('description')
                            ->rows(3),
                        
                        FileUpload::make('thumbnail')
                            ->image()
                            ->directory('form-thumbnails'),
                    ]),

                Section::make('Form Settings')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true),
                                
                                Toggle::make('allow_multiple_submissions')
                                    ->label('Allow Multiple Submissions')
                                    ->default(true),
                                
                                TextInput::make('submission_limit')
                                    ->label('Submission Limit')
                                    ->numeric()
                                    ->minValue(1)
                                    ->placeholder('Leave empty for unlimited'),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('start_date')
                                    ->label('Start Date'),
                                
                                DateTimePicker::make('end_date')
                                    ->label('End Date')
                                    ->after('start_date'),
                            ]),
                    ]),

                Section::make('Form Fields')
                    ->schema([
                        Repeater::make('fields')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        Select::make('type')
                                            ->options(FormField::getAvailableTypes())
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                if (in_array($state, FormField::getFieldTypesWithoutInput())) {
                                                    $set('required', false);
                                                }
                                            }),
                                        
                                        TextInput::make('label')
                                            ->required()
                                            ->hidden(fn (Forms\Get $get) => in_array($get('type'), FormField::getFieldTypesWithoutInput())),
                                        
                                        Toggle::make('required')
                                            ->default(false)
                                            ->hidden(fn (Forms\Get $get) => in_array($get('type'), FormField::getFieldTypesWithoutInput())),
                                    ]),
                                
                                TextInput::make('placeholder')
                                    ->visible(fn (Forms\Get $get) => in_array($get('type'), [
                                        FormField::TYPE_TEXT,
                                        FormField::TYPE_TEXTAREA,
                                        FormField::TYPE_EMAIL,
                                        FormField::TYPE_NUMBER,
                                    ])),
                                
                                Textarea::make('content')
                                    ->label('Content')
                                    ->visible(fn (Forms\Get $get) => in_array($get('type'), [
                                        FormField::TYPE_HEADING,
                                        FormField::TYPE_PARAGRAPH,
                                    ])),
                                
                                Textarea::make('help_text')
                                    ->label('Help Text')
                                    ->rows(2),
                                
                                Repeater::make('options')
                                    ->schema([
                                        TextInput::make('label')
                                            ->required(),
                                        TextInput::make('value')
                                            ->required(),
                                    ])
                                    ->visible(fn (Forms\Get $get) => in_array($get('type'), FormField::getFieldTypesWithOptions()))
                                    ->minItems(1)
                                    ->addActionLabel('Add Option')
                                    ->columnSpanFull(),
                            ])
                            ->minItems(1)
                            ->addActionLabel('Add Field')
                            ->reorderable()
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? $state['content'] ?? null)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug copied!')
                    ->limit(30),
                
                BooleanColumn::make('is_active')
                    ->label('Active'),
                
                TextColumn::make('submission_count')
                    ->label('Submissions')
                    ->getStateUsing(fn (Form $record) => $record->submissions()->count())
                    ->badge()
                    ->color('success'),
                
                TextColumn::make('submission_limit')
                    ->label('Limit')
                    ->placeholder('Unlimited'),
                
                TextColumn::make('start_date')
                    ->dateTime()
                    ->placeholder('No limit'),
                
                TextColumn::make('end_date')
                    ->dateTime()
                    ->placeholder('No limit'),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Form $record): string => route('forms.show', $record->slug))
                    ->openUrlInNewTab(),
                Action::make('viewSubmissions')
                    ->label('View Submissions')
                    ->icon('heroicon-o-document-text')
                    ->url(fn (Form $record): string => static::getUrl('edit', ['record' => $record->id]) . '#submissions')
                    ->color('info'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SubmissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
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
