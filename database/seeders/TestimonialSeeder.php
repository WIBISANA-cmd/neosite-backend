<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'client_name' => 'Rani Gunawan',
                'company' => 'Lumina Beauty',
                'position' => 'CMO',
                'content' => 'Tim NeoSite cepat tanggap dan hasil desainnya clean. Tracking kampanye jadi jauh lebih jelas.',
                'rating' => 5,
                'photo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330',
                'is_featured' => true,
            ],
            [
                'client_name' => 'Fajar Mahendra',
                'company' => 'Orbit Fintech',
                'position' => 'Product Lead',
                'content' => 'Mereka bantu kami ship landing page dalam seminggu dengan performa yang kencang.',
                'rating' => 5,
            ],
            [
                'client_name' => 'Citra Adiningrum',
                'company' => 'Astra Logistics',
                'position' => 'Ops Manager',
                'content' => 'Dashboard tracking mereka memotong waktu monitoring harian kami sampai 40%.',
                'rating' => 4,
            ],
        ];

        foreach ($items as $item) {
            Testimonial::create($item);
        }
    }
}
