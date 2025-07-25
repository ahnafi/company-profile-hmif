<?php

namespace App\Filament\Finance\Resources\KreusCashResource\Pages;

use App\Filament\Finance\Resources\KreusCashResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListKreusCashes extends ListRecords
{
    protected static string $resource = KreusCashResource::class;

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
