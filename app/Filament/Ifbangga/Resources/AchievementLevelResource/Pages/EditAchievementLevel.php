<?php

namespace App\Filament\Ifbangga\Resources\AchievementLevelResource\Pages;

use App\Filament\Ifbangga\Resources\AchievementLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAchievementLevel extends EditRecord
{
    protected static string $resource = AchievementLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
