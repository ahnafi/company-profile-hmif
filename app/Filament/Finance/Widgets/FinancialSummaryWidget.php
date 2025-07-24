<?php

namespace App\Filament\Finance\Widgets;

use App\Models\Transaction;
use App\Models\Fund;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialSummaryWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        $totalFunds = Fund::count();
        
        // Count funds with positive and negative balances
        $fundsWithPositiveBalance = Fund::withSum(['transactions as total_income' => function ($query) {
            $query->where('type', 'income');
        }], 'amount')
        ->withSum(['transactions as total_expense' => function ($query) {
            $query->where('type', 'expense');
        }], 'amount')
        ->get()
        ->filter(function ($fund) {
            $income = $fund->total_income ?? 0;
            $expense = $fund->total_expense ?? 0;
            return ($income - $expense) > 0;
        })
        ->count();

        return [
            Stat::make('Total Dana', $totalFunds)
                ->description('Jumlah dana yang dikelola')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),
                
            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalIncome, 0, ',', '.'))
                ->description('Total seluruh pemasukan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalExpense, 0, ',', '.'))
                ->description('Total seluruh pengeluaran')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
                
            Stat::make('Saldo Bersih', 'Rp ' . number_format($balance, 0, ',', '.'))
                ->description($balance >= 0 ? 'Surplus' : 'Defisit')
                ->descriptionIcon($balance >= 0 ? 'heroicon-m-arrow-up' : 'heroicon-m-arrow-down')
                ->color($balance >= 0 ? 'success' : 'danger'),
                
            Stat::make('Dana Beraldo Positif', $fundsWithPositiveBalance)
                ->description("Dari {$totalFunds} total dana")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
        ];
    }
}
