<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            \App\Models\User::create([
                'name' => "Admin User $i",
                'email' => "admin$i@gmail.com",
                'password' => bcrypt('123123123'),
                'role' => 'admin',
            ]);
        }

        \App\Models\User::create([
            'name' => 'dani',
            'email' => 'romadani.student@unibamadura.ac.id',
            'password' => bcrypt('12345678'),
            'role' => 'superadmin',
        ]);
    }
}
