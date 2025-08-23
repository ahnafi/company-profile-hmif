<?php

namespace App\Filament\Resources\WorkProgramAdministratorResource\Pages;

use App\Filament\Resources\WorkProgramAdministratorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkProgramAdministrator extends EditRecord
{
    protected static string $resource = WorkProgramAdministratorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
