<?php

namespace Database\Seeders;

use App\Models\WorkProgram;
use App\Models\WorkProgramAdministrator;
use Illuminate\Database\Seeder;

class EdukasiWorkProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ID Divisi Edukasi (diasumsikan 4 berdasarkan urutan)
        $edukasiDivisionId = 4;

        // Data untuk program kerja "Informatic Study Club"
        $isc = WorkProgram::create([
            'name' => 'Informatic Study Club',
            'description' => 'Informatics Study Club adalah program dari Divisi Edukasi Himpunan Mahasiswa Informatika Unsoed untuk membantu mahasiswa mempersiapkan UTS dan UAS. Program ini menyediakan “Bank Soal dan Bank Materi” berisi kumpulan materi dan soal ujian dari tahun-tahun sebelumnya. Mahasiswa dapat mengakses semuanya melalui platform yang telah disediakan. Dengan tema “Learning by Studying”, program ini juga mempublikasikan “Konten Edukasi” berupa materi perkuliahan di Instagram edukasi, sehingga mahasiswa dapat memperluas wawasan dan memahami materi perkuliahan secara lebih optimal dan terarah.',
            'type' => 'work_program', // Program Kerja Kecil
            'images' => [],
            'division_id' => $edukasiDivisionId,
        ]);

        // PJ untuk Informatic Study Club
        WorkProgramAdministrator::create(['position' => 'ketua', 'work_program_id' => $isc->id, 'administrator_id' => 15]); // Hafizh Naufal Raditya
        WorkProgramAdministrator::create(['position' => 'ketua', 'work_program_id' => $isc->id, 'administrator_id' => 13]); // Wendy Virtus
        WorkProgramAdministrator::create(['position' => 'ketua', 'work_program_id' => $isc->id, 'administrator_id' => 14]); // Bunga Budi Ambarwati

        // Data untuk program kerja "Sosialisasi KP, TA, dan MBKM"
        $sosialisasi = WorkProgram::create([
            'name' => 'Sosialisasi KP, TA, dan MBKM',
            'description' => 'Program ini bertujuan membantu mahasiswa memahami Kerja Praktik, Tugas Akhir, dan MBKM, serta memperkenalkan Sistem Informasi Kerja Praktik (SIKAP) untuk mempermudah administrasi. Disediakan pula Repository Kerja Praktik dan MBKM yang mencatat judul laporan, nama penulis, kontak, lokasi, dan jenis program berdasarkan pengalaman mahasiswa tahun sebelumnya. Dengan tema “Strategi Sukses Menyelesaikan Tugas Akhir, Kerja Praktik, dan MBKM”, program ini membantu mahasiswa merencanakan kegiatan akademik secara efektif dan memanfaatkan SIKAP serta repository untuk menentukan arah dan tujuan Kerja Praktik dan MBKM mereka.',
            'type' => 'work_program', // Program Kerja Sedang
            'images' => [],
            'division_id' => $edukasiDivisionId,
        ]);

        // PJ untuk Sosialisasi KP, TA, dan MBKM
        WorkProgramAdministrator::create(['position' => 'ketua', 'work_program_id' => $sosialisasi->id, 'administrator_id' => 12]); // Alya Luthfi Kharimah

        // Data untuk agenda kerja "Mahasiswa Berprestasi"
        $mawapres = WorkProgram::create([
            'name' => 'Mahasiswa Berprestasi',
            'description' => 'Mahasiswa Berprestasi merupakan agenda kerja yang bertujuan untuk mengumpulkan dan menyeleksi mahasiswa yang memiliki prestasi khususnya bidang akademik di Jurusan Informatika Unsoed. Mahasiswa yang lolos seleksi akan menjadi delegasi mewakili Jurusan Informatika Unsoed ke tingkat fakultas.',
            'type' => 'work_agenda', // Agenda Kerja
            'images' => [],
            'division_id' => $edukasiDivisionId,
        ]);

        // PJ untuk Mahasiswa Berprestasi
        WorkProgramAdministrator::create(['position' => 'ketua', 'work_program_id' => $mawapres->id, 'administrator_id' => 16]); // Maharani Tri Wahyuningrum
    }
}
