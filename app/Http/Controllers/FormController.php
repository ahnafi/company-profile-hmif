<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FormController extends Controller
{
    public function show(string $slug)
    {
        $form = Form::where('slug', $slug)->firstOrFail();
        
        if (!$form->isAcceptingSubmissions()) {
            return view('forms.closed', compact('form'));
        }
        
        return view('forms.show', compact('form'));
    }
    
    public function submit(Request $request, string $slug)
    {
        $form = Form::where('slug', $slug)->firstOrFail();
        
        if (!$form->isAcceptingSubmissions()) {
            return response()->json(['error' => 'Form is not accepting submissions'], 422);
        }
        
        // Check if user already submitted and multiple submissions not allowed
        if (!$form->allow_multiple_submissions) {
            $existingSubmission = FormSubmission::where('form_id', $form->id)
                ->where('submitted_by_email', $request->input('submitted_by_email'))
                ->exists();
                
            if ($existingSubmission) {
                return response()->json(['error' => 'You have already submitted this form'], 422);
            }
        }
        
        // Validate form data
        $rules = $this->buildValidationRules($form->fields);
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        // Extract form data
        $formData = [];
        foreach ($form->fields as $field) {
            if (isset($field['type']) && !in_array($field['type'], ['heading', 'paragraph'])) {
                $fieldName = $this->getFieldName($field);
                
                // Handle file uploads
                if ($field['type'] === 'file') {
                    if ($request->hasFile($fieldName)) {
                        $file = $request->file($fieldName);
                        $path = $file->store('form-submissions', 'public');
                        $formData[$field['label']] = $path;
                    } else {
                        $formData[$field['label']] = null;
                    }
                }
                // Handle array values properly (for checkboxes)
                elseif ($field['type'] === 'checkbox') {
                    $value = $request->input($fieldName);
                    $formData[$field['label']] = is_array($value) ? $value : [];
                } else {
                    $formData[$field['label']] = $request->input($fieldName);
                }
            }
        }
        
        // Create submission
        FormSubmission::create([
            'form_id' => $form->id,
            'data' => $formData,
            'submitted_by_name' => $request->input('submitted_by_name'),
            'submitted_by_email' => $request->input('submitted_by_email'),
            'submitted_by_phone' => $request->input('submitted_by_phone'),
            'ip_address' => $request->ip(),
        ]);
        
        return response()->json(['success' => 'Form submitted successfully']);
    }
    
    private function buildValidationRules(array $fields): array
    {
        $rules = [];
        
        foreach ($fields as $field) {
            if (!isset($field['type']) || in_array($field['type'], ['heading', 'paragraph'])) {
                continue;
            }
            
            $fieldName = $this->getFieldName($field);
            $fieldRules = [];
            
            if ($field['required'] ?? false) {
                $fieldRules[] = 'required';
            }
            
            switch ($field['type']) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'file':
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'max:10240'; // 10MB max
                    break;
                case 'select':
                case 'radio':
                    if (isset($field['options']) && is_array($field['options'])) {
                        $validValues = array_column($field['options'], 'value');
                        $fieldRules[] = 'in:' . implode(',', $validValues);
                    }
                    break;
                case 'checkbox':
                    $fieldRules[] = 'array';
                    if (isset($field['options']) && is_array($field['options'])) {
                        $validValues = array_column($field['options'], 'value');
                        $fieldRules[] = 'in:' . implode(',', $validValues);
                    }
                    // For checkbox, the field name should include []
                    $rules[$fieldName . '.*'] = $fieldRules;
                    continue 2; // Skip the normal rule assignment
            }
            
            if (!empty($fieldRules)) {
                $rules[$fieldName] = $fieldRules;
            }
        }
        
        return $rules;
    }
    
    private function getFieldName(array $field): string
    {
        return 'field_' . md5($field['label'] ?? '');
    }
}
