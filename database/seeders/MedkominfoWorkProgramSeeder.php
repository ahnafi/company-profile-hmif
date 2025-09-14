<?php

namespace Database\Seeders;

use App\Models\WorkProgram;
use App\Models\WorkProgramAdministrator;
use Illuminate\Database\Seeder;

class MedkominfoWorkProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ID Divisi Media Komunikasi dan Informasi (diasumsikan 5 berdasarkan urutan)
        $medkominfoDivisionId = 5;

        // Data dari dokumen
        $workProgramsData = [
            [
                'name' => 'MEDSOS',
                'description' => 'Agenda kerja Media Sosial adalah rencana pengelolaan setiap platform Media Sosial HMIF Unsoed dalam menyebarkan informasi dan menjalin komunikasi, baik dengan pihak internal maupun eksternal, melalui Instagram, YouTube, TikTok, dan LinkedIn.',
                'type' => 'work_agenda',
                'pjs' => [48], // Diva Syahita Mawarni
            ],
            [
                'name' => 'I-MAGZ',
                'description' => 'I-Magz (Informatics Magazine) merupakan informasi di lingkungan Jurusan Informatika Unsoed yang menyajikan berbagai kumpulan informasi serta menjadi platform bagi mahasiswa untuk menyalurkan ide, gagasan, dan pandangan mereka mengenai isu-isu kampus, sosial, dan perkembangan teknologi. Diharapkan, informasi yang dipublikasikan dapat menjangkau seluruh keluarga Jurusan Informatika serta masyarakat luas.',
                'type' => 'work_agenda',
                'pjs' => [49], // Salsabila Firzah Amanina
            ],
            [
                'name' => 'I-TALK',
                'description' => 'I-Talks (Informatic Talks) adalah konten audiovisual yang diselenggarakan oleh HMIF Unsoed bersama narasumber yang kompeten, membahas topik serta isu terkini. Konten ini berfungsi sebagai media informasi, hiburan, serta sarana untuk menyampaikan informasi terbaru seputar Jurusan Informatika.',
                'type' => 'work_agenda',
                'pjs' => [47], // Daffa Salman Fauzan Santoso
            ],
        ];

        // Looping untuk membuat setiap program kerja dan penanggung jawabnya
        foreach ($workProgramsData as $data) {
            $workProgram = WorkProgram::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'type' => $data['type'],
                'images' => [],
                'division_id' => $medkominfoDivisionId,
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
