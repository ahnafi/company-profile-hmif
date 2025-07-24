<?php

namespace App\Filament\Finance\Resources\AdministratorResource\Pages;

use App\Filament\Finance\Resources\AdministratorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdministrators extends ListRecords
{
    protected static string $resource = AdministratorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
