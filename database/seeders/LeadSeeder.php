<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads = [
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi@example.com',
                'whatsapp' => '+62812340001',
                'service_interest' => 'Landing Page',
                'budget_estimate' => '5-10 juta',
                'message' => 'Butuh landing page untuk kampanye iklan bulan depan.',
                'status' => 'baru',
            ],
            [
                'name' => 'Sinta Laras',
                'email' => 'sinta@example.com',
                'whatsapp' => '+62812340002',
                'service_interest' => 'Company Profile',
                'budget_estimate' => '10-15 juta',
                'message' => 'Perlu redesign website corporate dan optimasi SEO.',
                'status' => 'diproses',
            ],
        ];

        foreach ($leads as $lead) {
            Lead::create($lead);
        }
    }
}
