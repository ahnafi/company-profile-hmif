<?php

namespace App\Filament\Resources\ProposalAchievementResource\Pages;

use App\Filament\Resources\ProposalAchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProposalAchievements extends ListRecords
{
    protected static string $resource = ProposalAchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
