<?php

namespace App\Filament\Finance\Resources\TransactionResource\Pages;

use App\Filament\Finance\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
}
