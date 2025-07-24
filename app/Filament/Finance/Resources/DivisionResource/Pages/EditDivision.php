<?php

namespace App\Filament\Finance\Resources\DivisionResource\Pages;

use App\Filament\Finance\Resources\DivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivision extends EditRecord
{
    protected static string $resource = DivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
