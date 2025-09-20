<?php

namespace Database\Seeders;

use App\Models\WorkProgram;
use App\Models\WorkProgramAdministrator;
use Illuminate\Database\Seeder;

class HumasWorkProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ID Divisi Humas (diasumsikan 6 berdasarkan urutan)
        $humasDivisionId = 6;

        // Data dari dokumen
        $workProgramsData = [
            [
                'name' => 'Pengabdian Masyarakat',
                'description' => 'Pengabdian Masyarakat merupakan wujud nyata kontribusi mahasiswa Jurusan Informatika dalam memberikan dampak positif bagi lingkungan sekitar dengan dua bentuk program. Melalui Informatika Mengajar, siswa/siswi SD/MI diberi edukasi untuk meningkatkan literasi teknologi dan kreativitas sejak dini. Sedangkan, melalui Informatika Berbagi, bantuan sosial diberikan kepada yang membutuhkan sehingga memperkuat komitmen HMIF Unsoed untuk memberikan manfaat langsung bagi masyarakat.',
                'type' => 'work_program', // Proker Sedang
                'pjs' => [19], // Yoga Adi Nugraha
            ],
            [
                'name' => 'Relasi',
                'description' => 'Relasi merupakan program yang memperkuat hubungan antara HMIF Unsoed dan himpunan mahasiswa lainnya melalui kegiatan interaktif seperti kunjungan, diskusi, dan tukar pengalaman. Program ini membuka peluang terciptanya komunikasi yang lebih erat dan mendorong kolaborasi berkelanjutan antar himpunan.',
                'type' => 'work_program', // Program Kerja Sedang
                'pjs' => [25], // Putri Isnaini Laksita Utami
            ],
            [
                'name' => 'Informatics Graduation & Supporter',
                'description' => 'Informatics Graduation & Supporter (I-Grads) merupakan simbol solidaritas, semangat juang, dan rasa bangga untuk seluruh mahasiswa Jurusan Informatika. Terdiri dari dua kegiatan utama, Graduation dalam I-Grads menjadi bentuk penyambutan sebagai penghormatan atas perjalanan akademik mahasiswa yang telah menyelesaikan studinya. Sedangkan, Supporter menjadi bagian dari I-Grads yang menyatukan semangat kebersamaan melalui bentuk dukungan kepada mahasiswa yang tengah berkompetisi.',
                'type' => 'work_program', // Program Kerja Sedang
                'pjs' => [23, 24], // Ali Muhammad Firdaus, Muhammad Rezqy Robiansyah
            ],
            [
                'name' => 'Pembekalan Wisuda',
                'description' => 'Pembekalan Wisuda hadir rutin setiap periode wisuda yang ditujukan bagi calon wisudawan/wisudawati Jurusan Informatika. Melalui sesi berbagi cerita bersama narasumber, program ini membantu calon wisudawan mempersiapkan diri menghadapi transisi dari dunia akademik ke dunia profesional setelah kelulusan dengan bekal wawasan, tips, dan motivasi yang relevan.',
                'type' => 'work_program', // Program Kerja Kecil
                'pjs' => [23], // Ali Muhammad Firdaus
            ],
            [
                'name' => 'Dies Natalis',
                'description' => 'Dies Natalis menjadi momen tahunan yang mempertemukan seluruh keluarga besar Jurusan Informatika Unsoed—mahasiswa aktif, dosen, hingga alumni—dalam satu perayaan kebersamaan. Pada tahun 2025 ini, Dies Natalis menginjak usia ke-17, lebih dari sekadar peringatan, melainkan dirangkai dalam dua bentuk kegiatan. Informatics Insight berisi diskusi inspiratif bersama alumni sebagai wadah kolaborasi lintas generasi, serta Malam Puncak sebagai ajang selebrasi, refleksi, dan dorongan untuk semangat berinovasi kembali terhadap perjalanan Jurusan Informatika di kemudian hari.',
                'type' => 'work_program', // Program Kerja Besar
                'pjs' => [22, 21], // Khansa Nur Khalisah, Aisyah Syifa Karima
            ],
            [
                'name' => 'Advokasi',
                'description' => 'Advokasi hadir sebagai wadah pendengar suara penting keluarga besar Jurusan Informatika melalui dua forum yang saling terhubung—satu untuk mendengar, satu untuk bergerak. Forum Pengaduan membuka kanal 24/7 melalui platform online, memungkinkan mahasiswa menyampaikan keluhan, kritik, dan saran terkait kinerja kepengurusan HMIF 2025 dan jurusan secara anonim atau terbuka. Sedangkan, Forum Diskusi kemudian mengubah aspirasi menjadi aksi, dengan pertemuan langsung bersama pihak jurusan untuk memastikan perubahan nyata terjadi.',
                'type' => 'work_agenda', // Agenda Kerja
                'pjs' => [20], // Huriyatun Nur Anajmi
            ],
        ];

        // Looping untuk membuat setiap program kerja dan penanggung jawabnya
        foreach ($workProgramsData as $data) {
            $workProgram = WorkProgram::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'type' => $data['type'],
                'images' => [],
                'division_id' => $humasDivisionId,
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
