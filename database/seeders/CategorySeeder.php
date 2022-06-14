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
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'gaming',
            'user_id' => 1,

        ]);
        Category::create([
            'name' => 'programming',
            'user_id' => 1,

        ]);
        Category::create([
            'name' => 'politics',
            'user_id' => 1,

        ]);
        Category::create([
            'name' => 'science',
            'user_id' => 1,

        ]);
        Category::create([
            'name' => 'technology',
            'user_id' => 1,

        ]);
    }
}
