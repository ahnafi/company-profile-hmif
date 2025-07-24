<?php

namespace App\Filament\Finance\Resources\FundResource\Pages;

use App\Filament\Finance\Resources\FundResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFund extends EditRecord
{
    protected static string $resource = FundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
