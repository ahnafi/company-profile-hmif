<?php

namespace App\Filament\Finance\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static string $view = 'filament.finance.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Finance\Widgets\FinancialSummaryWidget::class,
            \App\Filament\Finance\Widgets\FundBalanceWidget::class,
            \App\Filament\Finance\Widgets\RecentTransactionsWidget::class,
        ];
    }
}
