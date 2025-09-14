<?php

namespace Database\Seeders;

use App\Models\WorkProgram;
use App\Models\WorkProgramAdministrator;
use Illuminate\Database\Seeder;

class IltekWorkProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ID Divisi Keilmuan dan Teknologi (diasumsikan 3 berdasarkan urutan)
        $iltekDivisionId = 3;

        // Data dari dokumen
        $workProgramsData = [
            [
                'name' => 'Soedirman Technophoria',
                'description' => 'Soedirman Technophoria adalah program kerja yang mencakup lomba dan seminar nasional di bidang Web Development, bertujuan untuk memperkenalkan perkembangan teknologi kepada masyarakat umum dan mahasiswa Informatika Unsoed. [cite: 129] Program ini mengedukasi peserta tentang teknologi terkini, mengasah kemampuan networking, serta mendorong kreativitas dalam memanfaatkan teknologi untuk memecahkan masalah nyata. [cite: 130]',
                'type' => 'work_program', // Proker Besar
                'pjs' => [31, 32], // Iven Rival Pangestu, Melysa Ayu Wulan Sari
            ],
            [
                'name' => 'Workshop',
                'description' => 'Program kerja Workshop bertujuan memberikan mahasiswa Jurusan Informatika Unsoed pengetahuan dan pengalaman langsung di bidang web development melalui tema "Web Dev Kickstart: Fundamentals for Future Developers". [cite: 138] Workshop ini mencakup materi tentang teknologi web, diskusi, dan pembuatan mini proyek kelompok, yang akan membekali peserta dengan keterampilan dasar untuk menjadi profesional di bidang web development. [cite: 139]',
                'type' => 'work_program', // Proker Sedang
                'pjs' => [33], // Raihan Dwi Ananda Harvian
            ],
            [
                'name' => 'Paguyuban Sinau Programming',
                'description' => 'Paguyuban Sinau Programming (PSP) adalah program kerja komunitas pembelajaran teknologi informasi bagi mahasiswa Informatika Unsoed yang diadakan dua minggu sekali dalam bentuk bootcamp. [cite: 146] Batch pertama berfokus pada web development, dilengkapi sesi materi, praktik, proyek akhir, dan peluang delegasi lomba. [cite: 147] PSP bertujuan mengembangkan bakat, mempersiapkan mahasiswa bersaing di dunia TI, dan membuka ruang belajar bagi mahasiswa Unsoed. [cite: 148]',
                'type' => 'work_program', // Proker Sedang
                'pjs' => [30], // Muhammad Zaki Dzulfikar
            ],
            [
                'name' => 'TECHSCHOLAR',
                'description' => 'TechScholar adalah agenda kerja yang mengumpulkan dan menyebarluaskan informasi terkait lomba dan beasiswa di bidang Keilmuan dan Teknologi untuk mahasiswa Jurusan Informatika Unsoed.  Program ini menyediakan informasi lomba dan beasiswa melalui Instagram dan grup WhatsApp TechScholar, serta menawarkan subsidi biaya pendaftaran lomba untuk peserta yang memenuhi syarat. [cite: 156]',
                'type' => 'work_program', // Proker Sedang (Meskipun disebut agenda kerja di deskripsi, judulnya adalah Proker)
                'pjs' => [29], // Firyal Aufa Fahrudin
            ],
            [
                'name' => 'Gemastik Informatics Training',
                'description' => 'Gemastik Informatics Training adalah program yang bertujuan membina mahasiswa Jurusan Informatika Unsoed untuk mempersiapkan diri menghadapi kompetisi Gemastik tingkat nasional. [cite: 164] Program ini meliputi perencanaan, pelatihan intensif, serta pendampingan selama persiapan hingga kompetisi. [cite: 165]',
                'type' => 'work_program',
                'pjs' => [34], // Naufal Satrio Putra
            ],
            [
                'name' => 'Pengelolaan Website',
                'description' => 'Agenda Kerja Pengelolaan Website HMIF Unsoed bertujuan untuk menyediakan informasi yang akurat, lengkap, dan selalu diperbarui seputar Jurusan Informatika dan kegiatan HMIF. [cite: 173] Melalui pemeliharaan rutin, pembaruan konten, dan penyediaan formulir online, website ini menjadi sarana informasi dan penghubung bagi mahasiswa maupun masyarakat umum. [cite: 174]',
                'type' => 'work_agenda', // Agenda Kerja
                'pjs' => [28], // Atik Ahnafi Sulthon
            ],
        ];

        // Looping untuk membuat setiap program kerja dan penanggung jawabnya
        foreach ($workProgramsData as $data) {
            $workProgram = WorkProgram::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'type' => $data['type'],
                'images' => [],
                'division_id' => $iltekDivisionId,
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
