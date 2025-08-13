<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AchievementFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_id'       => ['nullable', 'integer', 'exists:achievement_types,id'],
            'category_id'   => ['nullable', 'integer', 'exists:achievement_categories,id'],
            'level_id'      => ['nullable', 'integer', 'exists:achievement_levels,id'],
            'study_program' => ['nullable', 'string', Rule::in(['Informatics', 'Computer Engineering'])], // adjust list
            'batch_year'    => ['nullable', 'digits:4', 'integer', 'min:2000'],
            'student_name'  => ['nullable', 'string', 'max:100'],
            'nim'           => ['nullable', 'string', 'max:9'],
        ];
    }

    public function messages(): array
    {
        return [
            'type_id.integer' => 'ID Tipe harus berupa angka.',
            'type_id.exists'  => 'Tipe yang dipilih tidak ada.',

            'category_id.integer' => 'ID Kategori harus berupa angka.',
            'category_id.exists'  => 'Kategori yang dipilih tidak ada.',

            'level_id.integer' => 'ID Tingkat harus berupa angka.',
            'level_id.exists'  => 'Tingkat yang dipilih tidak ada.',

            'study_program.in' => 'Program studi yang dipilih tidak valid.',

            'batch_year.digits' => 'Tahun harus terdiri dari 4 digit.',
            'batch_year.min'    => 'Tahun tidak boleh kurang dari 2000.',

            'student_name.string' => 'Nama harus berupa teks.',
            'student_name.max'    => 'Nama tidak boleh lebih dari 100 karakter.',
            'nim.string'          => 'NIM harus berupa teks.',
            'nim.max'             => 'NIM tidak boleh lebih dari 9 karakter.',
        ];
    }
}
