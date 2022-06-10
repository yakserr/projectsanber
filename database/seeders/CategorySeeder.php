<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'news',
        ]);
        Category::create([
            'name' => 'gaming',
        ]);
        Category::create([
            'name' => 'programming',
        ]);
        Category::create([
            'name' => 'politics',
        ]);
        Category::create([
            'name' => 'science',
        ]);
        Category::create([
            'name' => 'technology',
        ]);
    }
}
