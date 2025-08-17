<?php

namespace App\Filament\Ifbangga\Resources\AchievementCategoryResource\Pages;

use App\Filament\Ifbangga\Resources\AchievementCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAchievementCategories extends ListRecords
{
    protected static string $resource = AchievementCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
