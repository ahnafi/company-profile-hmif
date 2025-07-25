<?php

namespace App\Filament\MikatFinance\Resources\MikatCashResource\Pages;

use App\Filament\MikatFinance\Resources\MikatCashResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMikatCash extends EditRecord
{
    protected static string $resource = MikatCashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
