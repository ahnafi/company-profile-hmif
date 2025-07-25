<?php

namespace App\Filament\IltekFinance\Resources\IltekCashResource\Pages;

use App\Filament\IltekFinance\Resources\IltekCashResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIltekCash extends EditRecord
{
    protected static string $resource = IltekCashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
