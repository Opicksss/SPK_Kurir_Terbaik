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
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'dani',
            'email' => 'romadani.student@unibamadura.ac.id',
            'password' => bcrypt('12345678'),
            'role' => 'superadmin',
        ]);
    }
}
