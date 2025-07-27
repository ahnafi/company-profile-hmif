<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompetitionAchievementResource\Pages;
use App\Filament\Resources\CompetitionAchievementResource\RelationManagers;
use App\Models\CompetitionAchievement;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompetitionAchievementResource extends Resource
{
    protected static ?string $model = CompetitionAchievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Database IF Bangga';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('students')
                    ->required()
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('nim')->required(),
                        TextInput::make('name')->required(),
                        TextInput::make('year')->numeric()->required(),
                    ]),
                Forms\Components\Select::make('competition_level')
                    ->options([
                        'faculty' => 'Faculty',
                        'university' => 'University', 
                        'national' => 'National',
                        'international' => 'International',
                        'other' => 'Other'
                    ])
                    ->required(),
                Forms\Components\Select::make('competition_type')
                    ->options([
                        'academic' => 'Academic',
                        'nonacademic' => 'Non Academic'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('competition_year')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('event_name')
                    ->required(),
                Forms\Components\TextInput::make('organizer')
                    ->required(),
                Forms\Components\TextInput::make('achievement')
                    ->required(),
                Forms\Components\Select::make('team_type')
                    ->options([
                        'individual' => 'Individual',
                        'group' => 'Group'
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('competition_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('competition_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('competition_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('organizer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('achievement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('team_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompetitionAchievements::route('/'),
            'create' => Pages\CreateCompetitionAchievement::route('/create'),
            'edit' => Pages\EditCompetitionAchievement::route('/{record}/edit'),
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
