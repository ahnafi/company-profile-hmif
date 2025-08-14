<?php

namespace App\Filament\Resources\AchievementTypeResource\Pages;

use App\Filament\Resources\AchievementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAchievementType extends EditRecord
{
    protected static string $resource = AchievementTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
