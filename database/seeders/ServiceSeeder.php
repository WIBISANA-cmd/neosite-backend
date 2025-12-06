<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Company Profile',
                'description' => 'Website profil perusahaan modern dengan SEO dasar dan halaman dinamis.',
                'starting_price' => 7500000,
                'estimated_time' => '2-3 minggu',
            ],
            [
                'name' => 'Landing Page Kampanye',
                'description' => 'Landing page high-converting untuk produk atau event dengan integrasi analitik.',
                'starting_price' => 4500000,
                'estimated_time' => '1-2 minggu',
            ],
            [
                'name' => 'Toko Online',
                'description' => 'Ecommerce ringan dengan payment gateway lokal, katalog produk, dan dashboard.',
                'starting_price' => 12000000,
                'estimated_time' => '3-4 minggu',
            ],
            [
                'name' => 'Web App Kustom',
                'description' => 'Aplikasi web tailor-made untuk otomasi bisnis dan integrasi sistem.',
                'starting_price' => 20000000,
                'estimated_time' => '4-6 minggu',
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => Str::slug($service['name'])],
                [
                    ...$service,
                    'slug' => Str::slug($service['name']),
                    'is_active' => true,
                ]
            );
        }
    }
}
