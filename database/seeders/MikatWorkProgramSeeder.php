<?php

namespace Database\Seeders;

use App\Models\WorkProgram;
use App\Models\WorkProgramAdministrator;
use Illuminate\Database\Seeder;

class MikatWorkProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ID Divisi Minat dan Bakat (diasumsikan 7 berdasarkan urutan)
        $mikatDivisionId = 7;

        // Data dari dokumen
        $workProgramsData = [
            [
                'name' => 'Informatics Championship',
                'description' => 'Informatics Championship merupakan kegiatan yang memiliki tujuan untuk memberikan sarana dan wadah kepada mahasiswa jurusan Informatika Unsoed untuk dapat berkompetisi dalam kegiatan olahraga dan seni secara sportif dan kekeluargaan. Dengan adanya kegiatan ini, diharapkan mahasiswa akan semakin termotivasi untuk mengekspresikan dan mengasah minat, bakat, dan keterampilan mereka. Selain itu, kegiatan ini juga diharapkan dapat memperkuat ikatan antara anggota keluarga besar Informatika, baik dari mahasiswa aktif, alumni, dan dosen-dosen.',
                'type' => 'work_program', // Program Kerja Besar [cite: 3]
                'pjs' => [55], // Yustinus Ergi Owen Sinaga [cite: 4]
            ],
            [
                'name' => 'Pelatihan Desain',
                'description' => 'Pelatihan Desain merupakan salah satu program kerja yang ada di Divisi Minat dan Bakat HMIF Unsoed. Tujuan dari pelatihan desain ini adalah untuk mendukung mahasiswa jurusan Informatika Unsoed dalam menyalurkan dan meningkatkan skill desain maupun editing dengan menggunakan aplikasi seperti Photoshop, Figma, ataupun aplikasi lainnya.',
                'type' => 'work_program', // Program Kerja Kecil [cite: 11]
                'pjs' => [57], // Zainab Feizia [cite: 12]
            ],
            [
                'name' => 'Informatics Army',
                'description' => 'Informatics Army adalah agenda kerja yang dimana merupakan latihan rutin untuk mencari dan mengembangkan minat dan bakat pada bidang non akademik seperti olahraga, e-sport, dan seni (musik) yang dilakukan oleh mahasiswa jurusan Informatika.',
                'type' => 'work_agenda', // Agenda Kerja [cite: 20]
                'pjs' => [53, 54, 52, 56], // Afif Nur Rahman, Bagas Cahya Setiadi, Fawwaz Fathurr Rozaq Athaillah, Lula Khaisha Delavia
            ],
        ];

        // Looping untuk membuat setiap program kerja dan penanggung jawabnya
        foreach ($workProgramsData as $data) {
            $workProgram = WorkProgram::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'type' => $data['type'],
                'images' => [],
                'division_id' => $mikatDivisionId,
            ]);

            // Looping untuk menambahkan PJ (bisa lebih dari satu)
            foreach ($data['pjs'] as $pj_id) {
                WorkProgramAdministrator::create([
                    'position' => 'ketua',
                    'work_program_id' => $workProgram->id,
                    'administrator_id' => $pj_id,
                ]);
            }
        }
    }
}
