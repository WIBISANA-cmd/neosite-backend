<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama proses pembuatan website?',
                'answer' => 'Landing page 1-2 minggu, company profile 2-3 minggu, web app kustom 4-6 minggu tergantung kompleksitas.',
                'order' => 1,
            ],
            [
                'question' => 'Apakah bisa revisi desain?',
                'answer' => 'Bisa, termasuk 2-3 siklus revisi desain sebelum masuk development.',
                'order' => 2,
            ],
            [
                'question' => 'Apakah hosting dan domain disediakan?',
                'answer' => 'Kami dapat membantu pengadaan hosting dan domain atau menggunakan aset yang sudah Anda miliki.',
                'order' => 3,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq + ['is_active' => true]);
        }
    }
}
