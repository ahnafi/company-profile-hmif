<?php

namespace App\Filament\Finance\Resources\CashResource\Pages;

use App\Filament\Finance\Resources\CashResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCash extends EditRecord
{
    protected static string $resource = CashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
