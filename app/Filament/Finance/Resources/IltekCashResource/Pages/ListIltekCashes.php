<?php

namespace App\Filament\Finance\Resources\IltekCashResource\Pages;

use App\Filament\Finance\Resources\IltekCashResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListIltekCashes extends ListRecords
{
    protected static string $resource = IltekCashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Tampilkan semua' => Tab::make(),
            'Pemasukan' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', "income")),
            'Pengeluaran' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', "expense")),
            'Pengeluaran External' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', "external_expense")),
        ];
    }
}
