<?php

namespace Database\Seeders;

use App\Models\Download;
use Illuminate\Database\Seeder;

class DownloadableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $downloads = [
            [
                'name' => 'Berita Acara Validasi Nilai Untuk Transkrip',
                'description' => 'Formulir berita acara untuk validasi nilai yang akan digunakan dalam transkrip akademik mahasiswa',
                'file' => null,
                'link' => 'https://drive.google.com/open?id=17nL9bSMeBmIAN1V1iyYlGYM-ssN0ikdWTP2uVJjaeKI',
            ],
            [
                'name' => 'Form Pengajuan Penguji Pendadaran',
                'description' => 'Formulir untuk mengajukan penguji pada ujian pendadaran tugas akhir mahasiswa',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1ztx-RS2z8MfwjZBlkcVuhqJojr6RMBIB/view',
            ],
            [
                'name' => 'Lembar Permohonan TA',
                'description' => 'Formulir permohonan untuk memulai pengerjaan Tugas Akhir (TA)',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1ztx-RS2z8MfwjZBlkcVuhqJojr6RMBIB/view',
            ],
            [
                'name' => 'Form Serah Terima Laporan KP-TA',
                'description' => 'Formulir bukti serah terima laporan Kerja Praktik dan Tugas Akhir kepada pihak terkait',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1A1MwMNuNKzUCQFwxKac_49oTFllarRG7/view',
            ],
            [
                'name' => 'Form Pengajuan Pendadaran',
                'description' => 'Formulir untuk mengajukan jadwal ujian pendadaran setelah menyelesaikan Tugas Akhir',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1R4-mUe9WPtdIaazSz2SFSI2_FfSlKAJa/view',
            ],
            [
                'name' => 'Form Keterangan Masih Kuliah',
                'description' => 'Formulir untuk mendapatkan surat keterangan bahwa mahasiswa masih aktif kuliah',
                'file' => null,
                'link' => 'https://drive.google.com/open?id=1rr-EnN6jXD8tmZK5EXloOovj3_osi_c534sbJPLeua8',
            ],
            [
                'name' => 'Form Pengajuan Keringanan Biaya Pendidikan',
                'description' => 'Formulir untuk mengajukan permohonan keringanan atau pengurangan biaya pendidikan',
                'file' => null,
                'link' => 'https://drive.google.com/open?id=1b797PDiGHFy1O_dcUz_jzMWWTeQTVnoiCHBSRlaRl28',
            ],
            [
                'name' => 'Form Keterangan Sedang Tidak Menerima Beasiswa',
                'description' => 'Formulir surat keterangan yang menyatakan bahwa mahasiswa sedang tidak menerima beasiswa',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1gFxeO1rzn73Qu8I0B0q8Dq2fd_yJP1lc/view',
            ],
            [
                'name' => 'Form Pengajuan Revisi (Pembimbing dan Judul) KP-TA',
                'description' => 'Formulir untuk mengajukan perubahan pembimbing atau judul Kerja Praktik dan Tugas Akhir',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1yeywVrr24NyBwLyT3c49zrlerRIRgtil/view',
            ],
            [
                'name' => 'Lembar Permohonan KP',
                'description' => 'Formulir permohonan untuk memulai Kerja Praktik (KP)',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1tQkqbjBLnTQiCp1HIYiF99XUImpQzYYy/view',
            ],
            [
                'name' => 'Lembar Permohonan Kerja Praktik (FR-KP1)',
                'description' => 'Formulir resmi FR-KP1 untuk permohonan Kerja Praktik sesuai standar akademik',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/144vYbA5Bn0G8RPLznH90B5twq1_0550v/view',
            ],
            [
                'name' => 'Lembar Permohonan Pengantar KP-TA',
                'description' => 'Formulir permohonan surat pengantar untuk keperluan Kerja Praktik dan Tugas Akhir',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1cLU6_qNbelb0W9ijXbMNePrG02czdPiq/view',
            ],
            [
                'name' => 'Lembar Permohonan Seminar Hasil TA',
                'description' => 'Formulir untuk mengajukan jadwal seminar hasil penelitian Tugas Akhir',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1DCiHjb4w_XKmXYOu9xz880-N-zu-GGxx/view',
            ],
            [
                'name' => 'Lembar Permohonan Seminar KP',
                'description' => 'Formulir untuk mengajukan jadwal seminar Kerja Praktik setelah menyelesaikan kegiatan KP',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1paLwZFmQ7R74UDV5eLDVH158RufeDzHb/view',
            ],
            [
                'name' => 'Lembar Permohonan Seminar TA',
                'description' => 'Formulir untuk mengajukan jadwal seminar Tugas Akhir',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1DCiHjb4w_XKmXYOu9xz880-N-zu-GGxx/view',
            ],
            [
                'name' => 'Lembar Permohonan Ujian TA',
                'description' => 'Formulir untuk mengajukan jadwal ujian akhir Tugas Akhir (sidang)',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1JJwI7_2sp6-bitixKIsZB_xeWnmTwUWN/view',
            ],
            [
                'name' => 'Lembar Pengajuan Yudisium',
                'description' => 'Formulir pengajuan untuk mengikuti yudisium (wisuda) setelah menyelesaikan semua persyaratan akademik',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/10p6rFd3h82f_63X8akpd1qLqFyVWQWCw/view',
            ],
            [
                'name' => 'Surat Pengganti Sertifikat PKKMB yang Hilang',
                'description' => 'Formulir untuk mengajukan surat pengganti sertifikat PKKMB (Pengenalan Kehidupan Kampus Mahasiswa Baru) yang hilang',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1Rnwal2DNxhQp3mBxLOZaY9gKMRbXwFgY/view',
            ],
            [
                'name' => 'Lembar Permohonan Seminar Proposal TA',
                'description' => 'Formulir untuk mengajukan jadwal seminar proposal Tugas Akhir sebelum memulai penelitian',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/1bH0cF92nQqYR07pCziJUSLjwbY1brelH/view',
            ],
            [
                'name' => 'Lembar Permohonan Email Unsoed',
                'description' => 'Formulir untuk mengajukan pembuatan atau pemulihan akun email institusi Unsoed',
                'file' => null,
                'link' => 'https://drive.google.com/file/d/13-Rk4jZkQPq_d9c_-tcFaoEuvXPyaV4X/view',
            ],
            [
                'name' => 'Form Pengajuan Perpanjangan Tugas Akhir',
                'description' => 'Formulir untuk mengajukan perpanjangan waktu pengerjaan Tugas Akhir jika melewati batas waktu normal',
                'file' => null,
                'link' => 'https://docs.google.com/document/d/11C7nPmZzb4trw1SufRJXbkhwYkUUkOXK1PTFkHFcQXo/edit?usp=sharing',
            ],
        ];

        foreach ($downloads as $download) {
            Download::create($download);
        }

    }
}
