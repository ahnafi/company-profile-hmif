<?php

namespace App\Filament\Finance\Resources\CashResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CashFundsRelationManager extends RelationManager
{
    protected static string $relationship = 'cashFunds';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('fund_id')
                    ->relationship("fund","name")
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label("Tanggal")
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
                    ->label("Bulan")
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
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fund.name')
            ->columns([
                Tables\Columns\TextColumn::make('fund.name')
                    ->label('Dana')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('month')
                    ->label('Bulan')
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->prefix("Rp ")
                    ->numeric()
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->amount + $record->penalty),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
