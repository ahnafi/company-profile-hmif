<?php

namespace App\Filament\Finance\Resources\FundResource\Pages;

use App\Filament\Finance\Resources\FundResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFunds extends ListRecords
{
    protected static string $resource = FundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
