<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Database\Seeder;

class FormSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $forms = Form::all();
        
        foreach ($forms as $form) {
            // Create some sample submissions
            for ($i = 1; $i <= 3; $i++) {
                $data = [];
                
                foreach ($form->fields as $field) {
                    if (isset($field['type']) && !in_array($field['type'], ['heading', 'paragraph'])) {
                        switch ($field['type']) {
                            case 'text':
                            case 'email':
                                $data[$field['label']] = fake()->words(3, true);
                                break;
                            case 'textarea':
                                $data[$field['label']] = fake()->paragraph();
                                break;
                            case 'number':
                                $data[$field['label']] = fake()->numberBetween(1, 100);
                                break;
                            case 'date':
                                $data[$field['label']] = fake()->date();
                                break;
                            case 'select':
                            case 'radio':
                                if (isset($field['options']) && !empty($field['options'])) {
                                    $option = fake()->randomElement($field['options']);
                                    $data[$field['label']] = $option['value'];
                                }
                                break;
                            case 'checkbox':
                                if (isset($field['options']) && !empty($field['options'])) {
                                    // Select random number of options
                                    $selectedOptions = fake()->randomElements(
                                        array_column($field['options'], 'value'),
                                        fake()->numberBetween(1, min(3, count($field['options'])))
                                    );
                                    $data[$field['label']] = $selectedOptions;
                                }
                                break;
                        }
                    }
                }
                
                FormSubmission::create([
                    'form_id' => $form->id,
                    'data' => $data,
                    'submitted_by_name' => fake()->name(),
                    'submitted_by_email' => fake()->email(),
                    'submitted_by_phone' => fake()->phoneNumber(),
                    'ip_address' => fake()->ipv4(),
                ]);
            }
        }
    }
}
