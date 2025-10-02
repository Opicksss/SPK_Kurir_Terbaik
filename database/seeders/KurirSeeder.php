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
                'kode' => 'KUR001',
                'name' => 'John Doe',
                'alamat' => '123 Main St, Cityville',
                'nomor' => '081234567890',
                'tanggal_masuk' => '2020-01-15',
            ],
            [
                'kode' => 'KUR002',
                'name' => 'Jane Smith',
                'alamat' => '456 Oak St, Townsville',
                'nomor' => '082345678901',
                'tanggal_masuk' => '2019-03-22',
            ],
            [
                'kode' => 'KUR003',
                'name' => 'Mike Johnson',
                'alamat' => '789 Pine St, Villageville',
                'nomor' => '083456789012',
                'tanggal_masuk' => '2021-07-30',
            ],
        ]);
    }
}
