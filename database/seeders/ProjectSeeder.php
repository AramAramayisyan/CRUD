<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'First Product',
            'description' => 'This is the description of the first project.'
        ]);

        Product::create([
            'name' => 'Second Product',
            'description' => 'This is the description of the second project.'
        ]);

        Product::create([
            'name' => 'Third Product',
            'description' => 'This is the description of the third project.'
        ]);
    }
}
