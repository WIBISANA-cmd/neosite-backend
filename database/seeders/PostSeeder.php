<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Checklist Membuat Website Bisnis yang Siap Scale',
                'excerpt' => 'Dari hosting hingga automasi, ini checklist yang kami pakai untuk meluncurkan situs yang siap scale sejak hari pertama.',
                'content' => 'Kami memastikan fondasi teknis siap scale: arsitektur modular, caching, dan deployment pipeline yang rapi.',
                'category' => 'Tips',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f',
            ],
            [
                'title' => 'Kenapa Memilih Laravel + React untuk Proyek Anda',
                'excerpt' => 'Stack ini memberi keseimbangan antara kecepatan development dan performa tinggi.',
                'content' => 'Laravel menyediakan fondasi API yang aman, sementara React memberi UX interaktif yang responsif.',
                'category' => 'Tech',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475',
            ],
            [
                'title' => 'Studi Kasus: Launch Landing Page 7 Hari',
                'excerpt' => 'Bagaimana kami meluncurkan kampanye digital lengkap hanya dalam 7 hari.',
                'content' => 'Kami memulai dari copywriting, wireframe, hingga integrasi analitik dan handover.',
                'category' => 'Case Study',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1474631245212-32dc3c8310c6',
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    ...$post,
                    'slug' => Str::slug($post['title']),
                    'status' => 'published',
                    'published_at' => Carbon::now()->subDays(rand(1, 20)),
                ]
            );
        }
    }
}
