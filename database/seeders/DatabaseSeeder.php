<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            PortfolioSeeder::class,
            PostSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            LeadSeeder::class,
            ProjectSeeder::class,
            BlogCategorySeeder::class,
            PortfolioCategorySeeder::class,
            SettingSeeder::class,
        ]);
    }
}
