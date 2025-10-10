<?php

namespace App\Exports;

use App\Models\FormSubmission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class FormSubmissionsExcelExport implements FromCollection, WithHeadings, WithMapping
{
    protected $formId;
    protected $fieldNames = [];
    protected $submissions;

    public function __construct(?int $formId = null)
    {
        $this->formId = $formId;
        
        // Get submissions based on form ID
        $query = FormSubmission::with('form');
        
        if ($this->formId) {
            $query->where('form_id', $this->formId);
        }
        
        $this->submissions = $query->get();
        
        // Extract unique field names from submissions
        $allFieldNames = $this->submissions
            ->pluck('data')
            ->reduce(function ($carry, $data) {
                if (is_array($data)) {
                    return array_merge($carry, array_keys($data));
                }
                return $carry;
            }, []);
        
        $this->fieldNames = array_values(array_unique($allFieldNames));
    }

    public function collection()
    {
        return $this->submissions;
    }

    public function headings(): array
    {
        $baseHeadings = [
            'ID',
            'Form Title',
            'Nama',
            'Email',
            'Telepon',
            'IP Address',
        ];
        
        // Add dynamic field names as headings
        $fieldHeadings = $this->fieldNames;
        
        $baseHeadings = array_merge($baseHeadings, $fieldHeadings);
        $baseHeadings[] = 'Submitted At';
        
        return $baseHeadings;
    }

    public function map($submission): array
    {
        $baseData = [
            $submission->id,
            $submission->form->title ?? '',
            $submission->submitted_by_name ?? '',
            $submission->submitted_by_email ?? '',
            $submission->submitted_by_phone ?? '',
            $submission->ip_address ?? '',
        ];
        
        // Add values for each field
        $fieldValues = [];
        foreach ($this->fieldNames as $fieldName) {
            $value = $submission->data[$fieldName] ?? '';
            
            // Handle arrays (checkboxes)
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            
            // Handle file paths - convert to full URL
            if (is_string($value) && str_starts_with($value, 'form-submissions/')) {
                $value = url('storage/' . $value);
            }
            
            $fieldValues[] = $value;
        }
        
        $baseData = array_merge($baseData, $fieldValues);
        $baseData[] = $submission->created_at?->format('Y-m-d H:i:s') ?? '';
        
        return $baseData;
    }
}
