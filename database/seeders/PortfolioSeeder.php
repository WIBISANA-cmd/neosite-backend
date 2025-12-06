<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'project_name' => 'Astra Logistics',
                'description' => 'Portal monitoring logistik dengan dashboard real-time untuk tim operasional.',
                'category' => 'Web App',
                'industry' => 'Logistik',
                'demo_url' => 'https://example.com/demo-logistik',
                'image_url' => 'https://images.unsplash.com/photo-1529070538774-1843cb3265df',
                'tech_stack' => ['Laravel', 'React', 'TailwindCSS'],
            ],
            [
                'project_name' => 'Lumina Beauty',
                'description' => 'Ecommerce kosmetik dengan loyalty points dan rekomendasi produk.',
                'category' => 'Ecommerce',
                'industry' => 'Beauty',
                'demo_url' => 'https://example.com/lumina',
                'image_url' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518',
                'tech_stack' => ['Laravel', 'Livewire', 'MySQL'],
            ],
            [
                'project_name' => 'Orbit Fintech',
                'description' => 'Landing page produk fintech dengan kalkulator interaktif.',
                'category' => 'Landing Page',
                'industry' => 'Fintech',
                'demo_url' => 'https://example.com/orbit',
                'image_url' => 'https://images.unsplash.com/photo-1454165205744-3b78555e5572',
                'tech_stack' => ['React', 'TailwindCSS', 'Cloudflare'],
            ],
        ];

        foreach ($items as $item) {
            Portfolio::updateOrCreate(
                ['slug' => Str::slug($item['project_name'])],
                [
                    ...$item,
                    'slug' => Str::slug($item['project_name']),
                    'is_featured' => true,
                ]
            );
        }
    }
}
