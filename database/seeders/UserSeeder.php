<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
