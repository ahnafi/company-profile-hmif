<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Badan Pengurus Harian',
            'Kreasi dan Usaha',
            'Keilmuan dan Teknologi',
            'Edukasi',
            'Media Komunikasi dan Informasi',
            'Hubungan Masyarakat',
            'Minat dan Bakat',
            'Pengembangan Sumber Daya Mahasiswa',
            'Bendahara',
            'IfBangga',
            'artikel',
            'blog',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        $admin = [
            "name" => "Admin",
            "bio" => "Terus berjuang Informatika"
        ];

        $author = Author::create($admin);

        $article = Article::create([
            "title" => "PENTINGNYA BACKUP DATA JANGAN SAMPAI ARSIP KAMU HILANG !!!",
            "thumbnail" => "thumbnails/backupdata.jpg",
            "content" => "
*PENTINGNYA BACKUP DATA : JANGAN SAMPAI ARSIP KAMU HILANG !!*

*Apa Itu Backup Data?*
Backup data adalah proses membuat salinan cadangan dari data asli yang tersimpan di perangkat. Salinan ini dapat disimpan di perangkat berbeda, baik fisik seperti harddisk eksternal maupun digital seperti layanan cloud (Google Drive, OneDrive, dan sebagainya).
Tujuannya sederhana: mencegah kehilangan data akibat kerusakan perangkat, kesalahan pengguna, atau bahkan serangan siber. Data hasil backup bisa digunakan kembali saat data utama tidak bisa diakses.

*Kasus Nyata: Serangan Siber Pusat Data Nasional*
Baru-baru ini, Indonesia diguncang dengan serangan ransomware yang menyerang Pusat Data Nasional. Banyak data tidak dapat diakses, bahkan menghambat layanan publik. Bayangkan jika kita mengalami hal serupa tanpa cadangan data kekacauan pasti terjadi.

*Tips Backup Data yang Efektif*
Agar proses backup berjalan maksimal dan data tetap aman, berikut beberapa langkah yang bisa kamu ikuti:
1. Gunakan Software Otomatis
Manfaatkan aplikasi atau software yang bisa menjadwalkan backup secara otomatis, misalnya harian atau mingguan. Banyak smartphone dan laptop saat ini sudah terintegrasi dengan layanan cloud seperti Google Drive atau iCloud.
2. Backup Secara Berkala
Jangan menunggu data rusak dulu baru backup! Tentukan jadwal rutin harian, mingguan, atau bulanan sesuai intensitas kerja dan pentingnya dokumen.
3. Simpan di Lokasi Berbeda
Jangan hanya menyimpan semua data di satu perangkat. Idealnya, salinan data disimpan di lokasi yang berbeda, misalnya:
- Harddisk eksternal
- Flashdisk
- Layanan cloud (Dropbox, OneDrive, dll)
4. Jangan Lupa Enkripsi dan Proteksi
Jika menyimpan data penting atau sensitif, gunakan proteksi tambahan seperti password atau enkripsi agar lebih aman.

*Jaga Aset Digitalmu, Mulai Sekarang*
Backup bukan hanya soal menjaga file, tapi soal menjaga kepercayaan, kinerja, dan kelangsungan organisasi. Kehilangan data bisa membuat pekerjaan terhambat, laporan hilang, atau dokumentasi kegiatan tidak lengkap.
Jadi, yuk mulai meluangkan waktu untuk melakukan backup secara rutin. Lebih baik sedia cadangan daripada kehilangan segalanya!
Referensi : https://www.rri.co.id/iptek/794918/pentingnya-backup-data-agar-tidak-kehilangan-data",
            "author_id" => $author->id,
            "category_id" => Category::where("slug", "badan-pengurus-harian")->first()->id,
        ]);

        Banner::create([
            'article_id' => $article->id,
        ]);
    }
}
