<?php

namespace App\Filament\Resources\CompetitionAchievementResource\Pages;

use App\Filament\Resources\CompetitionAchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompetitionAchievement extends EditRecord
{
    protected static string $resource = CompetitionAchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
