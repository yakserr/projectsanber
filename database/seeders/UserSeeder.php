<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'  => bcrypt('password'),
        ]);

        User::create([
            'name'      => 'testing',
            'email'     => 'testing@gmail.com',
            'email_verified_at' => now(),
            'password'  => bcrypt('password'),
        ]);
    }
}
