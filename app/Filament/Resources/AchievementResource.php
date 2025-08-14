<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Resources\AchievementResource\RelationManagers;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Select::make('students')
                    ->relationship('students', 'nim')
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->nim} - {$record->name}")
                    ->searchable(['name', 'nim'])
                    ->preload()
                    ->multiple()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('image')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('proof')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('awarded_at'),
                Forms\Components\Toggle::make('approval'),
                Forms\Components\Select::make('achievement_type_id')
                    ->relationship('achievementType', 'name')
                    ->required(),
                Forms\Components\Select::make('achievement_category_id')
                    ->relationship('achievementCategory', 'name')
                    ->required(),
                Forms\Components\Select::make('achievement_level_id')
                    ->relationship('achievementLevel', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('students.nim')
                    ->label('Students')
                    ->formatStateUsing(function ($state, $record) {
                        return $record->students->pluck('nim')->join(', ');
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('awarded_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('approval')
                    ->boolean(),
                Tables\Columns\TextColumn::make('achievementType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('achievementCategory.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('achievementLevel.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make("Approve")
                    ->color('success')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-check')
                    ->visible(fn ($record) => $record->approval === null)
                    ->action(fn ($record) => $record->update(['approval' => true]))
                    ->successNotificationTitle('Achievement approved successfully'),

                Tables\Actions\Action::make("Reject")
                    ->color('danger')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-mark')
                    ->visible(fn ($record) => $record->approval === null)
                    ->action(fn ($record) => $record->update(['approval' => false]))
                    ->successNotificationTitle('Achievement rejected'),

                // Define actions for the table
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
