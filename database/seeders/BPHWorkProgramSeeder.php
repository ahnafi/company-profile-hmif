<?php

namespace Database\Seeders;

use App\Models\WorkProgram;
use App\Models\WorkProgramAdministrator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BPHWorkProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data program kerja dari dokumen
        $workProgramsData = [
            [
                'name' => 'RAPAT PLENO',
                'description' => 'Forum bulanan wajib bagi seluruh pengurus HMIF Unsoed 2025 untuk update progres, mengidentifikasi kendala, dan memastikan program kerja berjalan lancar melalui evaluasi serta diskusi strategis.',
                'pj_id' => 5, // Dimas Rafif Zaidan
            ],
            [
                'name' => 'Pemeliharaan Sekretariat',
                'description' => 'Pemeliharaan Sekretariat agar tetap nyaman dan rapi. Dilakukan setiap dua minggu, pengurus bergiliran membersihkan, mengecek fasilitas, dan mengelola inventaris dengan pengawasan BPH.',
                'pj_id' => 6, // Naila Alifatul Mabruroh
            ],
            [
                'name' => 'Encryption Book',
                'description' => 'Dokumen rahasia berisi catatan dan rekaman suara terkait refleksi, evaluasi, serta kendala kepengurusan.',
                'pj_id' => 3, // Ayu Fitrianingsih
            ],
            [
                'name' => 'Uang Kas',
                'description' => 'Iuran bulanan pengurus HMIF untuk menjaga kestabilan keuangan dan mendukung pelaksanaan program kerja HMIF.',
                'pj_id' => 8, // Amalia Maharani Andessy
            ],
            [
                'name' => 'Uang Deposit',
                'description' => 'Kontribusi awal pengurus sebagai jaminan keuangan organisasi, memastikan operasional berjalan lancar sepanjang tahun.',
                'pj_id' => 9, // Nayla Octavia Ramadhani
            ],
            [
                'name' => 'Informatics Control Unit',
                'description' => 'Unit pengawas kedisiplinan dan tanggung jawab pengurus melalui tata tertib, evaluasi kinerja, serta apresiasi terhadap Divisi of the month, Kadiv of the month, dan Staff of the month .',
                'pj_id' => 2, // Revalina Fidiya Anugrah
            ],
            [
                'name' => 'BPH Care',
                'description' => 'Forum diskusi dan dukungan antara BPH, Ketua, Wakil Ketua, dan setiap divisi.',
                'pj_id' => 1, // Muhammad Ilham Rafiqi
            ],
        ];

        // ID Divisi BPH (diasumsikan 1)
        $bphDivisionId = 1;

        // Looping untuk membuat setiap program kerja dan penanggung jawabnya
        foreach ($workProgramsData as $data) {
            $workProgram = WorkProgram::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'type' => 'work_agenda',
                'images' => [],
                'division_id' => $bphDivisionId,
            ]);

            WorkProgramAdministrator::create([
                'position' => 'ketua',
                'work_program_id' => $workProgram->id,
                'administrator_id' => $data['pj_id'],
            ]);
        }
    }
}
