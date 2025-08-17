<?php

namespace App\Filament\Ifbangga\Resources\AchievementTypeResource\Pages;

use App\Filament\Ifbangga\Resources\AchievementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAchievementTypes extends ListRecords
{
    protected static string $resource = AchievementTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
