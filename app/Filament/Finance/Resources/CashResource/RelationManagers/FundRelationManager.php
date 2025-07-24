<?php

namespace App\Filament\Finance\Resources\CashResource\RelationManagers;

use App\Models\Fund;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FundRelationManager extends RelationManager
{
    protected static string $relationship = 'funds';

    public function table(Table $table): Table
    {
        return $table
            ->allowDuplicates()
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label('Dana')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label("Tanggal")
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('month')
                    ->label("Bulan")
                    ->formatStateUsing(fn($state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Cash')
                    ->prefix("Rp ")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penalty')
                    ->label('Penalty')
                    ->prefix("Rp ")
                    ->numeric()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn(Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->required(),
                        Forms\Components\Select::make('month')
                            ->options([
                                "april" => "April",
                                "may" => "May",
                                "june" => "June",
                                "july" => "July",
                                "august" => "August",
                                "september" => "September",
                                "october" => "October",
                                "november" => "November"
                            ])
                            ->label('Month')
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Cash')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\TextInput::make('penalty')
                            ->label('Penalty')
                            ->numeric()
                            ->default(0)
                            ->required()
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->required(),
                        Forms\Components\Select::make('month')
                            ->options([
                                "april" => "April",
                                "may" => "May",
                                "june" => "June",
                                "july" => "July",
                                "august" => "August",
                                "september" => "September",
                                "october" => "October",
                                "november" => "November"
                            ])
                            ->label('Month')
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Cash')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\TextInput::make('penalty')
                            ->label('Penalty')
                            ->numeric()
                            ->default(0)
                            ->required()
                    ]),
                Tables\Actions\DetachAction::make("Hapus")
                    ->requiresConfirmation(),
            ]);
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DetachBulkAction::make(),
        //     ]),
        // ]);
    }
}
