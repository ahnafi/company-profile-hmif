<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalAchievementResource\Pages;
use App\Filament\Resources\ProposalAchievementResource\RelationManagers;
use App\Models\ProposalAchievement;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProposalAchievementResource extends Resource
{
    protected static ?string $model = ProposalAchievement::class;

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
                Forms\Components\Select::make('program_type')
                    ->options([
                        'p2mw' => 'P2MW',
                        'pkm' => 'PKM'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('program_title')
                    ->required(),
                Forms\Components\TextInput::make('program_year')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('achievement')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('achievement')
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
            'index' => Pages\ListProposalAchievements::route('/'),
            'create' => Pages\CreateProposalAchievement::route('/create'),
            'edit' => Pages\EditProposalAchievement::route('/{record}/edit'),
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
