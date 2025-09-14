<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturers = [
            [
                "name" => "Drs. Ir. Eddy Maryanto, M.Cs",
                "nip" => "196711101993031025",
                "image" => 'lecturer-images/eddy-maryanto.png',
                "type" => "informatics",
            ],
            [
                "name" => "Dr. Ir. Nurul Hidayat, S.Pt. M.Kom",
                "nip" => "197305172003121001",
                "image" => 'lecturer-images/nurul-hidayat.png',
                "type" => "informatics",
            ],
            [
                "name" => "Dr. Ir. Lasmedi Afuan, S.T., M.Cs.,IPM",
                "nip" => "198505102008121002",
                "image" => "lecturer-images/lasmedi-afuan.png",
                "type" => "informatics",
            ],
            [
                "name" => "Ir. Teguh Cahyono, S.T., M.Kom",
                "nip" => "197412102008011007",
                "image" => "lecturer-images/teguh-cahyono.png",
                "type" => "informatics",
            ],
            [
                "name" => "Ir. Bangun Wijayanto, ST, M.Cs.,IPM",
                "nip" => "198306182006041002",
                "image" => "lecturer-images/bangun-wijayanto.jpg",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Arief Kelik Nugroho, S.Kom., M.Cs",
                "nip" => "198512242015041001",
                "image" => "lecturer-images/arief-kelik-nugroho.png",
                "type" => "informatics",
            ],
            [
                "name" => "Ir. Nur Chasanah, S.Kom.,M.Kom",
                "nip" => "198903132015042004",
                "image" => "lecturer-images/nur-chasanah.png",
                "type" => "informatics",
            ],
            [
                "name" => "Ir. Dadang Iskandar, S.T., M.Eng",
                "nip" => "198312022015041001",
                "image" => "lecturer-images/dadang-iskandar.png",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Ir. Ipung Permadi, S.Si. M.Cs",
                "nip" => "198311162008121005",
                "image" => "lecturer-images/ipung-permadi.png",
                "type" => "informatics",
            ],
            [
                "name" => "Ir. Swahesti Puspita Rahayu, S.Kom. MT",
                "nip" => "198107052008012024",
                "image" => "lecturer-images/swahesti-puspita-rahayu.png",
                "type" => "informatics",
            ],
            [
                "name" => "Ir. Nofiyati, S.Kom., M.Kom., IPM",
                "nip" => "198108192024212012",
                "image" => "lecturer-images/nofiyati.png",
                "type" => "informatics",
            ],
            [
                "name" => "Ir. Yogiek Indra Kurniawan, S.T., M.T",
                "nip" => "198803122019031010",
                "image" => "lecturer-images/yogiek-indra-kurniawan.png",
                "type" => "informatics",
            ],
            [
                "name" => "Aini Hanifa, S.T., M.T",
                "nip" => "199306302019032028",
                "image" => "lecturer-images/aini-hanifa.png",
                "type" => "informatics",
            ],
            [
                "name" => "Nur Alfi Ekowati, S.Kom.,M.Sc",
                "nip" => "199001302025062006",
                "image" => "lecturer-images/nur-alfi-ekowati.png",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Mochamad Agri Triansyah, S.Kom., M.Kom",
                "nip" => "199408122023211023",
                "image" => "lecturer-images/mochamad-agri-triansyah.png",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Agus Darmawan, S.Kom.,M.Cs",
                "nip" => "199008172024061001",
                "image" => "lecturer-images/agus-darmawan.png",
                "type" => "informatics",
            ],
            [
                "name" => "Dwi Kurnia Wibowo, S.Kom.,M.Kom",
                "nip" => "199607102024061002",
                "image" => "lecturer-images/dwi-kurnia-wibowo.png",
                "type" => "informatics",
            ],
            [
                "name" => "Muhammad Ihsan Fawzi, S.Kom., M.Kom.",
                "nip" => "199705132024061001",
                "image" => "lecturer-images/muhammad-ihsan-fawzi.png",
                "type" => "informatics",
            ],
            [
                "name" => "Devi Astri Nawangnugraeni, S.Pd.,M.Kom",
                "nip" => "199312042024062004",
                "image" => "lecturer-images/devi-astri-nawangnugraeni.jpg",
                "type" => "informatics",
            ],
            [
                "name" => "Mohammad Irham Akbar, S.Kom.,M.Cs",
                "nip" => "199408102022031010",
                "image" => "lecturer-images/mohammad-irham-akbar.png",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Ucky Pradestha Novettralita S.Pd., M.Kom.",
                "nip" => "199311272025061009",
                "image" => "lecturer-images/ucky-pradestha-novettralita.jpg",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Dr. M. Agus Syamsul Arifin S.St., M.Kom.",
                "nip" => "198808192025061001",
                "image" => "lecturer-images/m-agus-syamsul-arifin.jpg",
                "type" => "informatics",
            ],
            [
                "name" => "Puteri Awaliatush Shofro M.Kom.",
                "nip" => "199706092025062011",
                "image" => "lecturer-images/puteri-awaliatush-shofro.jpg",
                "type" => "informatics",
            ],
            [
                "name" => "Helmi Roichatul Jannah M.Kom.",
                "nip" => "199411052025062010",
                "image" => "lecturer-images/helmi-roichatul-jannah.jpg",
                "type" => "informatics",
            ],
            [
                "name" => "Nurul Tiara Kadir S.Kom., M.Eng.",
                "nip" => "199507302025062005",
                "image" => "lecturer-images/nurul-tiara-kadir.jpg",
                "type" => "informatics",
            ],
            [
                "name" => "Axl Adilla S.Kom., M.Cs.",
                "nip" => "199811132025061008",
                "image" => "lecturer-images/axl-adilla.jpg",
                "type" => "informatics",
            ],
            [
                "name" => "Moeng Sakmar, S.Kom., M.Kom.",
                "nip" => "199501162025061006",
                "image" => "lecturer-images/moeng-sakmar.jpg",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Emha Diambang Ramadhany, M.Kom.",
                "nip" => "199302222025061004",
                "image" => "lecturer-images/emha-diambang-ramadhany.jpg",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Azis Amirulbahar,S.Pd., M.T.I.",
                "nip" => "199206242025061002",
                "image" => "lecturer-images/azis-amirulbahar.jpg",
                "type" => "computer_engineering",
            ],
            [
                "name" => "Khadijah Febriana Rukhmanti Udhayana Hr, S.T., M.Kom",
                "nip" => "199102142025062007",
                "image" => "lecturer-images/khadijah-febriana-rukhmanti-udhayana-hr.png",
                "type" => "informatics",
            ],
        ];

        foreach ($lecturers as $lecturer) {
            Lecturer::create($lecturer);
        }
    }
}
