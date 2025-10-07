<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rekap;
use App\Models\Kurir;
use App\Models\Kriteria;
use Carbon\Carbon;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;

class RekapSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('rekaps')->insert([
            [
                'kurir_id' => 1, // Assuming this corresponds to 'dani'
                'kriteria_id' => 1, // Keterlambatan
                'nilai' => 3, // Example value
                'date' => 2025-01-01, // Current date
            ],
            [
                'kurir_id' => 1, // Assuming this corresponds to 'dani'
                'kriteria_id' => 1, // Keterlambatan
                'nilai' => 3, // Example value
                'date' => 2025-05-01, // Current date
            ],

            [
                'kurir_id' => 1,
                'kriteria_id' => 3, // Total Trip Ojek
                'nilai' => 250,
                'date' => 2025-04-01, // Current date
            ],

            [
                'kurir_id' => 2,
                'kriteria_id' => 4, // Total Trip Barang
                'nilai' => 30,
                'date' => 2025-04-01, // Current date
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
             [
                'kurir_id' => 2,
                'kriteria_id' => 4, // Total Trip Barang
                'nilai' => 30,
                'date' => 2025-04-05, // Current date
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kurir_id' => 1,
                'kriteria_id' => 5, // Kesalahan Pengiriman
                'nilai' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],


            // Entries for Sovi
            [
                'kurir_id' => 2, // Sovi
                'kriteria_id' => 1,
                'nilai' => 10,
                'date' => 2025-01-01, // Current date
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kurir_id' => 2, // Sovi
                'kriteria_id' => 1,
                'nilai' => 7,
                'date' => 2025-02-01, // Current date
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'kurir_id' => 2,
                'kriteria_id' => 3,
                'nilai' => 50,
                'date' => 2025-03-01,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

             [
                'kurir_id' => 2,
                'kriteria_id' => 3,
                'nilai' => 5,
                'date' => 2025-03-05,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],


            [
                'kurir_id' => 2,
                'kriteria_id' => 4,
                'nilai' => 120,
                'date' => 2025-03-01,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kurir_id' => 2,
                'kriteria_id' => 5,
                'nilai' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
