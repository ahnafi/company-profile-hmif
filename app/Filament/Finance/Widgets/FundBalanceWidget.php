<?php

namespace App\Filament\Finance\Widgets;

use App\Models\Fund;
use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class FundBalanceWidget extends BaseWidget
{
    protected static ?string $heading = 'Rekapitulasi Saldo Dana';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Fund::query()
                    ->withSum(['transactions as total_income' => function (Builder $query) {
                        $query->where('type', 'income');
                    }], 'amount')
                    ->withSum(['transactions as total_expense' => function (Builder $query) {
                        $query->where('type', 'expense');
                    }], 'amount')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Dana')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_income')
                    ->label('Pemasukan')
                    ->money('IDR')
                    ->color('success')
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->label('Total Pemasukan')
                            ->money('IDR'),
                    ]),
                Tables\Columns\TextColumn::make('total_expense')
                    ->label('Pengeluaran')
                    ->money('IDR')
                    ->color('danger')
                    ->default(0)
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->label('Total Pengeluaran')
                            ->money('IDR'),
                    ]),
                Tables\Columns\TextColumn::make('balance')
                    ->label('Saldo')
                    ->money('IDR')
                    ->weight('bold')
                    ->getStateUsing(function ($record) {
                        $income = $record->total_income ?? 0;
                        $expense = $record->total_expense ?? 0;
                        return $income - $expense;
                    })
                    ->color(function ($record) {
                        $income = $record->total_income ?? 0;
                        $expense = $record->total_expense ?? 0;
                        $balance = $income - $expense;
                        return $balance >= 0 ? 'success' : 'danger';
                    })
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Saldo')
                            ->using(function () {
                                $totalIncome = Transaction::where('type', 'income')->sum('amount');
                                $totalExpense = Transaction::where('type', 'expense')->sum('amount');
                                return $totalIncome - $totalExpense;
                            })
                            ->money('IDR'),
                    ]),
            ])
            ->filters([
                Tables\Filters\Filter::make('positive_balance')
                    ->label('Saldo Positif')
                    ->query(function (Builder $query): Builder {
                        return $query->havingRaw('(COALESCE(total_income, 0) - COALESCE(total_expense, 0)) > 0');
                    }),
                Tables\Filters\Filter::make('negative_balance')
                    ->label('Saldo Negatif')
                    ->query(function (Builder $query): Builder {
                        return $query->havingRaw('(COALESCE(total_income, 0) - COALESCE(total_expense, 0)) < 0');
                    }),
            ])
            ->defaultSort('name')
            ->striped()
            ->paginated(false);
    }
}
