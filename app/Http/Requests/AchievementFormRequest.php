<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AchievementFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_id'       => ['required', 'integer', 'exists:achievement_types,id'],
            'category_id'   => ['required', 'integer', 'exists:achievement_categories,id'],
            'level_id'      => ['required', 'integer', 'exists:achievement_levels,id'],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'awarded_at'    => ['required', 'date'],
            'image'         => ['required', 'image', 'max:2048'],
            'proof'         => ['required', 'file', 'max:2048', 'mimes:pdf,doc,docx,png,jpg,jpeg'],

            // Multiple students by NIM
            'nim'           => ['required', 'array', 'min:1'],
            'nim.*'         => ['required', 'string', 'size:9', Rule::exists('students', 'nim')],
        ];
    }

    public function messages(): array
    {
        return [
            'type_id.required' => 'Tipe prestasi wajib dipilih.',
            'type_id.exists'   => 'Tipe yang dipilih tidak ada.',

            'category_id.required' => 'Kategori prestasi wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak ada.',

            'level_id.required' => 'Tingkat prestasi wajib dipilih.',
            'level_id.exists'   => 'Tingkat yang dipilih tidak ada.',

            'name.required' => 'Nama prestasi wajib diisi.',
            'name.max'      => 'Nama prestasi maksimal 255 karakter.',

            'awarded_at.required' => 'Tanggal penghargaan wajib diisi.',
            'awarded_at.date'     => 'Tanggal penghargaan tidak valid.',

            'image.image' => 'File gambar tidak valid.',
            'image.max'   => 'Ukuran gambar maksimal 2MB.',

            'proof.file'  => 'Bukti harus berupa file.',
            'proof.mimes' => 'Bukti hanya boleh berupa PDF, DOC, DOCX, PNG, JPG, atau JPEG.',
            'proof.max'   => 'Ukuran bukti maksimal 2MB.',

            'nim.required' => 'Minimal satu NIM mahasiswa harus diisi.',
            'nim.array'    => 'Format NIM tidak valid.',
            'nim.*.required' => 'NIM mahasiswa wajib diisi.',
            'nim.*.string'   => 'NIM mahasiswa harus berupa teks.',
            'nim.*.size'     => 'NIM mahasiswa harus terdiri dari 9 karakter.',
            'nim.*.exists'   => 'NIM mahasiswa :input tidak ditemukan.',
        ];
    }
}
