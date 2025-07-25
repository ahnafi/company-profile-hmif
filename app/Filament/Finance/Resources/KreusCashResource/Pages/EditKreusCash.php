<?php

namespace App\Filament\Finance\Resources\KreusCashResource\Pages;

use App\Filament\Finance\Resources\KreusCashResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKreusCash extends EditRecord
{
    protected static string $resource = KreusCashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
