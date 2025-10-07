<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kurirs')->insert([
            [
                'kode' => 'KR1',
                'name' => 'dani',
                'alamat' => '123 Main St, Cityville',
                'nomor' => '081234567890',
                'tanggal_masuk' => '2024-01-15',
            ],
            [
                'kode' => 'KR2',
                'name' => 'Sovi',
                'alamat' => '456 Oak St, Townsville',
                'nomor' => '082345678901',
                'tanggal_masuk' => '2024-03-22',
            ],
            [
                'kode' => 'KR3',
                'name' => 'lilik',
                'alamat' => '789 Pine St, Villageville',
                'nomor' => '083456789012',
                'tanggal_masuk' => '2025-07-30',
            ],
             [
                'kode' => 'KR4',
                'name' => 'lilik',
                'alamat' => '789 Pine St, Villageville',
                'nomor' => '083456789000',
                'tanggal_masuk' => '2025-07-30',
            ],
        ]);
    }
}
