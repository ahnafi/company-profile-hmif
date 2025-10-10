<?php

namespace App\Filament\Exports;

use App\Models\FormSubmission;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FormSubmissionExporter extends Exporter
{
    protected static ?string $model = FormSubmission::class;

    public function getColumns(): array
    {
        // Extract unique field names from THE RECORDS BEING EXPORTED
        // Note: We fetch records here to determine which fields to include
        $records = $this->getRecords();
        
        $allFieldNames = $records
            ->pluck('data')
            ->reduce(function ($carry, $data) {
                if (is_array($data)) {
                    return array_merge($carry, array_keys($data));
                }
                return $carry;
            }, []);
        
        $uniqueFieldNames = array_values(array_unique($allFieldNames));
        
        // Base columns
        $columns = [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('form.title')
                ->label('Form Title'),
            ExportColumn::make('submitter_name')
                ->label('Submitter Name'),
            ExportColumn::make('submitter_email')
                ->label('Submitter Email'),
            ExportColumn::make('submitter_phone')
                ->label('Submitter Phone'),
            ExportColumn::make('ip_address')
                ->label('IP Address'),
        ];
        
        // Add dynamic columns for fields found in THIS export
        foreach ($uniqueFieldNames as $fieldName) {
            $columns[] = ExportColumn::make('field_' . md5($fieldName))
                ->label($fieldName)
                ->state(function (FormSubmission $record) use ($fieldName) {
                    $value = $record->data[$fieldName] ?? '';
                    
                    // Handle arrays (like checkboxes)
                    if (is_array($value)) {
                        return empty($value) ? '' : implode(', ', $value);
                    }
                    
                    // Handle file paths - show filename only
                    if (is_string($value) && str_starts_with($value, 'form-submissions/')) {
                        return basename($value);
                    }
                    
                    return (string) $value;
                });
        }
        
        $columns[] = ExportColumn::make('created_at')
            ->label('Submitted At')
            ->formatStateUsing(fn ($state) => $state?->format('Y-m-d H:i:s'));
        
        return $columns;
    }
    
    protected function getRecords(): Collection
    {
        // Get the query with all modifications applied
        $query = static::getModel()::query();
        $query = static::modifyQuery($query);
        
        // Get all records that will be exported
        return $query->get();
    }
    
    public static function modifyQuery(Builder $query): Builder
    {
        return $query->with('form');
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
