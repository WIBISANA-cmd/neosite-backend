<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = User::where('email', 'client@neosite.test')->first();

        if (!$client) {
            return;
        }

        $projects = [
            [
                'project_name' => 'Ecommerce Lumina',
                'status' => 'development',
                'progress_percent' => 65,
                'deadline' => now()->addWeeks(2),
            ],
            [
                'project_name' => 'Landing Page Orbit',
                'status' => 'desain',
                'progress_percent' => 35,
                'deadline' => now()->addWeek(),
            ],
        ];

        foreach ($projects as $project) {
            Project::create([
                ...$project,
                'client_id' => $client->id,
            ]);
        }
    }
}
