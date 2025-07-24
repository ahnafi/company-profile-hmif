<?php

namespace App\Filament\Finance\Resources;

use App\Filament\Finance\Resources\CashResource\Pages;
use App\Filament\Finance\Resources\CashResource\RelationManagers;
use App\Models\Cash;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CashResource extends Resource
{
    protected static ?string $model = Cash::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('administrator_id')
                    ->relationship('administrator', 'name')
                    ->disabledOn("edit")
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('administrator.name')
                    ->description(fn($record) => $record->administrator?->division?->name)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('april')
                    ->label('April')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'april')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'april')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
                Tables\Columns\TextColumn::make('may')
                    ->label('May')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'may')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'may')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
                Tables\Columns\TextColumn::make('june')
                    ->label('June')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'june')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'june')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
                Tables\Columns\TextColumn::make('july')
                    ->label('July')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'july')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'july')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
                Tables\Columns\TextColumn::make('august')
                    ->label('August')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'august')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'august')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
                Tables\Columns\TextColumn::make('september')
                    ->label('September')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'september')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'september')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
                Tables\Columns\TextColumn::make('october')
                    ->label('October')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'october')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'october')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
                Tables\Columns\TextColumn::make('november')
                    ->label('November')
                    ->formatStateUsing(
                        fn($record) => $record->cashFunds->where('month', 'november')
                            ->sum(fn($fund) => $fund->amount + $fund->penalty)
                    )
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total')
                            ->using(function () {
                                return \App\Models\Cash::with('cashFunds')->get()
                                    ->sum(fn($record) => $record->cashFunds->where('month', 'november')
                                        ->sum(fn($fund) => $fund->amount + $fund->penalty)
                                    );
                            })
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ])
                    ->prefix("Rp "),
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
                Tables\Actions\EditAction::make(),
            ]);
        //            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                    Tables\Actions\ForceDeleteBulkAction::make(),
//                    Tables\Actions\RestoreBulkAction::make(),
//                ]),
//            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CashFundsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCashes::route('/'),
            'create' => Pages\CreateCash::route('/create'),
            'edit' => Pages\EditCash::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['cashFunds', 'administrator.division']) // Eager load relationships
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
