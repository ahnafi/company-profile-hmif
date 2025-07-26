<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Form 1: Contact Form
        Form::create([
            'title' => 'Form Kontak HMIF',
            'slug' => 'form-kontak-hmif',
            'description' => 'Form untuk menghubungi HMIF ITB',
            'is_active' => true,
            'allow_multiple_submissions' => true,
            'fields' => [
                [
                    'type' => 'heading',
                    'content' => 'Informasi Pribadi',
                ],
                [
                    'type' => 'text',
                    'label' => 'Nama Lengkap',
                    'required' => true,
                    'placeholder' => 'Masukkan nama lengkap Anda',
                ],
                [
                    'type' => 'email',
                    'label' => 'Email',
                    'required' => true,
                    'placeholder' => 'contoh@email.com',
                ],
                [
                    'type' => 'select',
                    'label' => 'Status',
                    'required' => true,
                    'options' => [
                        ['label' => 'Mahasiswa IF ITB', 'value' => 'mahasiswa_if'],
                        ['label' => 'Alumni IF ITB', 'value' => 'alumni_if'],
                        ['label' => 'Dosen IF ITB', 'value' => 'dosen_if'],
                        ['label' => 'Lainnya', 'value' => 'lainnya'],
                    ],
                ],
                [
                    'type' => 'heading',
                    'content' => 'Pesan Anda',
                ],
                [
                    'type' => 'select',
                    'label' => 'Kategori Pesan',
                    'required' => true,
                    'options' => [
                        ['label' => 'Pertanyaan Umum', 'value' => 'pertanyaan'],
                        ['label' => 'Kritik dan Saran', 'value' => 'kritik_saran'],
                        ['label' => 'Kerjasama', 'value' => 'kerjasama'],
                        ['label' => 'Lainnya', 'value' => 'lainnya'],
                    ],
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Pesan',
                    'required' => true,
                    'placeholder' => 'Tuliskan pesan Anda di sini...',
                    'help_text' => 'Jelaskan pesan Anda dengan detail.',
                ],
            ],
        ]);

        // Sample Form 2: Event Registration
        Form::create([
            'title' => 'Pendaftaran Seminar IT',
            'slug' => 'pendaftaran-seminar-it',
            'description' => 'Form pendaftaran untuk mengikuti Seminar IT yang diselenggarakan oleh HMIF ITB',
            'is_active' => true,
            'allow_multiple_submissions' => false,
            'submission_limit' => 100,
            'start_date' => now()->subDays(1),
            'end_date' => now()->addDays(7),
            'fields' => [
                [
                    'type' => 'paragraph',
                    'content' => 'Selamat datang di form pendaftaran Seminar IT 2025. Harap isi data dengan benar dan lengkap.',
                ],
                [
                    'type' => 'heading',
                    'content' => 'Data Peserta',
                ],
                [
                    'type' => 'text',
                    'label' => 'Nama Lengkap',
                    'required' => true,
                    'placeholder' => 'Sesuai KTP/KTM',
                ],
                [
                    'type' => 'text',
                    'label' => 'NIM/NIP',
                    'required' => true,
                    'placeholder' => 'Nomor Induk Mahasiswa/Pegawai',
                ],
                [
                    'type' => 'email',
                    'label' => 'Email',
                    'required' => true,
                ],
                [
                    'type' => 'text',
                    'label' => 'Nomor WhatsApp',
                    'required' => true,
                    'placeholder' => '08xxxxxxxxxx',
                ],
                [
                    'type' => 'radio',
                    'label' => 'Jenis Kelamin',
                    'required' => true,
                    'options' => [
                        ['label' => 'Laki-laki', 'value' => 'L'],
                        ['label' => 'Perempuan', 'value' => 'P'],
                    ],
                ],
                [
                    'type' => 'select',
                    'label' => 'Asal Institusi',
                    'required' => true,
                    'options' => [
                        ['label' => 'ITB', 'value' => 'itb'],
                        ['label' => 'UI', 'value' => 'ui'],
                        ['label' => 'UGM', 'value' => 'ugm'],
                        ['label' => 'ITS', 'value' => 'its'],
                        ['label' => 'Lainnya', 'value' => 'lainnya'],
                    ],
                ],
                [
                    'type' => 'heading',
                    'content' => 'Preferensi Acara',
                ],
                [
                    'type' => 'checkbox',
                    'label' => 'Sesi yang Diminati',
                    'help_text' => 'Pilih sesi yang ingin Anda ikuti (boleh lebih dari satu)',
                    'options' => [
                        ['label' => 'AI & Machine Learning', 'value' => 'ai_ml'],
                        ['label' => 'Web Development', 'value' => 'web_dev'],
                        ['label' => 'Mobile Development', 'value' => 'mobile_dev'],
                        ['label' => 'Data Science', 'value' => 'data_science'],
                        ['label' => 'Cybersecurity', 'value' => 'cybersecurity'],
                    ],
                ],
                [
                    'type' => 'radio',
                    'label' => 'Kebutuhan Sertifikat',
                    'required' => true,
                    'options' => [
                        ['label' => 'Ya, saya membutuhkan sertifikat', 'value' => 'ya'],
                        ['label' => 'Tidak, saya tidak membutuhkan sertifikat', 'value' => 'tidak'],
                    ],
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Harapan dari Seminar',
                    'required' => false,
                    'placeholder' => 'Ceritakan harapan Anda mengikuti seminar ini...',
                ],
            ],
        ]);

        // Sample Form 3: Feedback Form
        Form::create([
            'title' => 'Form Feedback Website HMIF',
            'slug' => 'feedback-website-hmif',
            'description' => 'Bantu kami meningkatkan website HMIF dengan memberikan feedback Anda',
            'is_active' => true,
            'allow_multiple_submissions' => true,
            'fields' => [
                [
                    'type' => 'heading',
                    'content' => 'Penilaian Website',
                ],
                [
                    'type' => 'radio',
                    'label' => 'Bagaimana penilaian Anda terhadap tampilan website?',
                    'required' => true,
                    'options' => [
                        ['label' => 'Sangat Baik', 'value' => '5'],
                        ['label' => 'Baik', 'value' => '4'],
                        ['label' => 'Cukup', 'value' => '3'],
                        ['label' => 'Kurang', 'value' => '2'],
                        ['label' => 'Sangat Kurang', 'value' => '1'],
                    ],
                ],
                [
                    'type' => 'radio',
                    'label' => 'Seberapa mudah navigasi website ini?',
                    'required' => true,
                    'options' => [
                        ['label' => 'Sangat Mudah', 'value' => '5'],
                        ['label' => 'Mudah', 'value' => '4'],
                        ['label' => 'Cukup', 'value' => '3'],
                        ['label' => 'Sulit', 'value' => '2'],
                        ['label' => 'Sangat Sulit', 'value' => '1'],
                    ],
                ],
                [
                    'type' => 'checkbox',
                    'label' => 'Fitur apa yang paling berguna bagi Anda?',
                    'options' => [
                        ['label' => 'Informasi Berita', 'value' => 'berita'],
                        ['label' => 'Data Dosen', 'value' => 'dosen'],
                        ['label' => 'Unduhan Dokumen', 'value' => 'unduhan'],
                        ['label' => 'Informasi Organisasi', 'value' => 'organisasi'],
                        ['label' => 'Form Builder', 'value' => 'form_builder'],
                    ],
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Saran Perbaikan',
                    'required' => false,
                    'placeholder' => 'Berikan saran untuk perbaikan website...',
                    'help_text' => 'Saran Anda sangat berharga untuk pengembangan website',
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Kritik',
                    'required' => false,
                    'placeholder' => 'Sampaikan kritik konstruktif Anda...',
                ],
            ],
        ]);
    }
}
