<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'NeoSite',
                'email' => 'hello@neosite.id',
                'whatsapp' => '+628123456789',
                'address' => 'Jakarta & Remote',
                'operational_hours' => 'Senin - Jumat, 09.00 - 18.00',
                'social_links' => [
                    'instagram' => 'https://instagram.com/neosite',
                    'linkedin' => 'https://linkedin.com/company/neosite',
                ],
                'default_seo' => [
                    'title' => 'NeoSite - Web Studio',
                    'description' => 'Jasa pembuatan website modern, cepat, scalable.',
                ],
            ]
        );
    }
}
