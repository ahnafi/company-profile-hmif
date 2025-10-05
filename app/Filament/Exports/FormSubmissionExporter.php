<?php

namespace App\Filament\Exports;

use App\Models\FormSubmission;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class FormSubmissionExporter extends Exporter
{
    protected static ?string $model = FormSubmission::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('submitted_by_name')
                ->label('Name'),
            ExportColumn::make('submitted_by_email')
                ->label('Email'),
            ExportColumn::make('submitted_by_phone')
                ->label('Phone'),
            ExportColumn::make('ip_address')
                ->label('IP Address'),
            ExportColumn::make('data')
                ->label('Form Data')
                ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT)),
            ExportColumn::make('created_at')
                ->label('Submitted At'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your form submission export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getJobQueue(): string|null {
        return null;
    }
}
