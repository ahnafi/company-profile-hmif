<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Achievement;
use App\Models\AchievementCategory;
use App\Models\AchievementLevel;
use App\Models\AchievementType;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        // Seed static lookup data
        $types = [
            ['name' => 'Individu'],
            ['name' => 'Kelompok'],
        ];
        $categories = [
            ['name' => 'Akademik'],
            ['name' => 'Non-Akademik'],
            ['name' => 'Pendanaan PKM'],
            ['name' => 'Beasiswa'],
            ['name' => 'Lomba'],
            ['name' => 'Pendanaan P2MW'],
        ];
        $levels = [
            ['name' => 'Internasional'],
            ['name' => 'Nasional'],
            ['name' => 'Regional'],
            ['name' => 'Universitas'],
            ['name' => 'Fakultas'],
        ];

        foreach ($types as $type) {
            AchievementType::firstOrCreate($type);
        }
        foreach ($categories as $category) {
            AchievementCategory::firstOrCreate($category);
        }
        foreach ($levels as $level) {
            AchievementLevel::firstOrCreate($level);
        }

        // Example students to attach achievements to
        $students = Student::take(5)->get(); // Make sure you already have at least 5 students

        // Achievements seed data
        $achievements = [
            [
                'name' => 'Juara 1 Lomba Pemrograman',
                'description' => 'Memenangkan lomba pemrograman tingkat nasional.',
                'image' => 'achievement_images/gambar.jpg',
                'proof' => 'achievement_proofs/sertifikat.pdf',
                'awarded_at' => '2023-05-15',
                'approval' => true,
                'achievement_type_id' => 1,
                'achievement_category_id' => 5,
                'achievement_level_id' => 2,
            ],
            [
                'name' => 'Beasiswa Unggulan',
                'description' => 'Menerima beasiswa unggulan dari pemerintah.',
                'image' => 'achievement_images/gambar.jpg',
                'proof' => 'achievement_proofs/sertifikat.pdf',
                'awarded_at' => '2024-01-10',
                'approval' => true,
                'achievement_type_id' => 1,
                'achievement_category_id' => 4,
                'achievement_level_id' => 3,
            ],
            [
                'name' => 'Juara 2 Hackathon Internasional',
                'description' => 'Meraih peringkat 2 di ajang hackathon internasional.',
                'image' => 'achievement_images/gambar.jpg',
                'proof' => 'achievement_proofs/sertifikat.pdf',
                'awarded_at' => '2022-11-05',
                'approval' => true,
                'achievement_type_id' => 2,
                'achievement_category_id' => 5,
                'achievement_level_id' => 1,
            ],
            [
                'name' => 'Pendanaan PKM Riset',
                'description' => 'Mendapatkan pendanaan Program Kreativitas Mahasiswa bidang riset.',
                'image' => 'achievement_images/gambar.jpg',
                'proof' => 'achievement_proofs/sertifikat.pdf',
                'awarded_at' => '2023-03-20',
                'approval' => true,
                'achievement_type_id' => 2,
                'achievement_category_id' => 3,
                'achievement_level_id' => 4,
            ],
            [
                'name' => 'Delegasi Seminar Nasional',
                'description' => 'Menjadi delegasi seminar nasional bidang teknologi.',
                'image' => 'achievement_images/gambar.jpg',
                'proof' => 'achievement_proofs/sertifikat.pdf',
                'awarded_at' => '2024-06-12',
                'approval' => true,
                'achievement_type_id' => 1,
                'achievement_category_id' => 1,
                'achievement_level_id' => 2,
            ],
        ];

        // Insert achievements and attach students
        foreach ($achievements as $achievementData) {
            $achievement = Achievement::create($achievementData);

            // Attach random 1-3 students to each achievement
            $achievement->students()->attach(
                $students->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
