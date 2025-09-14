<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FundSeeder::class,
            DivisionSeeder::class,
            RoleAndPermissionSeeder::class,
            Informatics2021Seeder::class,
            Informatics2022Seeder::class,
            Informatics2023Seeder::class,
            Informatics2024Seeder::class,
            Informatics2025Seeder::class,
            ComputerEngineering2024Seeder::class,
            ComputerEngineering2025Seeder::class,
            AchievementSeeder::class,
            LecturerSeeder::class
        ]);
    }
}
