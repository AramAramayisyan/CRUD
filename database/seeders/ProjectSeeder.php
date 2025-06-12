<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'name' => 'First Project',
            'description' => 'This is the description of the first project.'
        ]);

        Project::create([
            'name' => 'Second Project',
            'description' => 'This is the description of the second project.'
        ]);

        Project::create([
            'name' => 'Third Project',
            'description' => 'This is the description of the third project.'
        ]);
    }
}
