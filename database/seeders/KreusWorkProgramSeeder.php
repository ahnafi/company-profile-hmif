<?php

namespace Database\Seeders;

use App\Models\WorkProgram;
use App\Models\WorkProgramAdministrator;
use Illuminate\Database\Seeder;

class KreusWorkProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ID Divisi Kreasi dan Usaha (diasumsikan 2 berdasarkan urutan)
        $kreusDivisionId = 2;

        // Data dari dokumen
        $workProgramsData = [
            [
                'name' => 'SOSIALISASI PKM',
                'description' => 'Sosialisasi Program Kreativitas Mahasiswa (PKM) merupakan kegiatan yang bertujuan memberikan informasi seputar PKM kepada mahasiswa Informatika dan Teknik Komputer. Kegiatan ini diharapkan dapat meningkatkan pemahaman dan partisipasi mahasiswa dalam PKM.',
                'type' => 'work_program', // Program Kerja
                'pjs' => [39], // Ahmad Zaky
            ],
            [
                'name' => 'INFINITY WEAR',
                'description' => 'Infinity Wear adalah agenda kerja HMIF yang memproduksi atribut seperti jaket, jersey, topi, dan aksesoris sebagai sumber pemasukan kas. Produk dijual melalui sistem pre-order dan ready stock, dikelola oleh Divisi Kreasi dan Usaha, serta menjadi wadah kreatif yang merepresentasikan identitas HMIF.',
                'type' => 'work_agenda', // Agenda Kerja
                'pjs' => [36, 40], // Rajendra Rangga Priyatama, Dera Amelia
            ],
            [
                'name' => 'Sponsorship',
                'description' => 'Sponsorship merupakan agenda kerja yang bertujuan mendapatkan dukungan finansial dari sponsor untuk mendukung pendanaan dan meningkatkan kualitas program kerja HMIF.',
                'type' => 'work_agenda', // Agenda Kerja
                'pjs' => [41, 35], // Gerard Roland Kusuma Sarwoko, Novia Rizky Aryani
            ],
            [
                'name' => 'CEMARA',
                'description' => 'Cemilan Mahasiswa Gembira adalah agenda wirausaha HMIF yang menjual jajanan ringan melalui sistem pre-order. Program ini bertujuan menambah pemasukan himpunan serta melatih keterampilan berwirausaha anggota Divisi Kreasi dan Usaha.',
                'type' => 'work_agenda', // Agenda Kerja
                'pjs' => [38, 42], // Finda Wulan Febrianti, Nesa Dwi Cahyani
            ],
        ];

        // Looping untuk membuat setiap program kerja dan penanggung jawabnya
        foreach ($workProgramsData as $data) {
            $workProgram = WorkProgram::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'type' => $data['type'],
                'images' => [],
                'division_id' => $kreusDivisionId,
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
