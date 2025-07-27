<?php

namespace App\Filament\Resources\ProposalAchievementResource\Pages;

use App\Filament\Resources\ProposalAchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProposalAchievement extends EditRecord
{
    protected static string $resource = ProposalAchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
