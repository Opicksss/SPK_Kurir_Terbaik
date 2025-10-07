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
            ['kurir_id' => 1, 'kriteria_id' => 1, 'nilai' => 3, 'date' => '2025-01-01', ],
            ['kurir_id' => 1, 'kriteria_id' => 1, 'nilai' => 2, 'date' =>' 2025-05-01', ],
            ['kurir_id' => 1, 'kriteria_id' => 2, 'nilai' => 1, 'date' =>' 2025-01-01', ],


            [ 'kurir_id' => 1,'kriteria_id' => 3, 'nilai' => 250,'date' => '2025-04-01',],
            [ 'kurir_id' => 1,'kriteria_id' => 4, 'nilai' => 50, 'date' => '2025-03-05',],
            [ 'kurir_id' => 1,'kriteria_id' => 5, 'nilai' => 8, 'date' => '2025-03-05',],



            // Entries for Sovi
            [ 'kurir_id' => 2, 'kriteria_id' => 1, 'nilai' => 10,  'date' => '2025-01-01', ],
            [ 'kurir_id' => 2, 'kriteria_id' => 1, 'nilai' => 2, 'date' => '2025-02-01', ],
            ['kurir_id' => 2, 'kriteria_id' => 2, 'nilai' => 1, 'date' =>' 2025-01-01', ],
            [ 'kurir_id' => 2, 'kriteria_id' => 3, 'nilai' => 50, 'date' => '2025-03-01',],

             [ 'kurir_id' => 2, 'kriteria_id' => 3, 'nilai' => 5, 'date' => '2025-03-05',],


            ['kurir_id' => 2,'kriteria_id' => 4, 'nilai' => 120, 'date' => '2025-03-01',],
            ['kurir_id' => 2,'kriteria_id' => 5,'nilai' => 11,'date' => '2025-03-01',],


            ['kurir_id' => 3, 'kriteria_id' => 1, 'nilai' => 17, 'date' => '2025-01-20'],
            ['kurir_id' => 3, 'kriteria_id' => 2, 'nilai' => 1, 'date' =>' 2025-01-01', ],
            ['kurir_id' => 3, 'kriteria_id' => 3, 'nilai' => 205, 'date' => '2025-01-20'],
            ['kurir_id' => 3, 'kriteria_id' => 4, 'nilai' => 55, 'date' => '2025-01-20'],
            ['kurir_id' => 3, 'kriteria_id' => 5, 'nilai' => 14, 'date' => '2025-01-20'],

            ['kurir_id' => 4, 'kriteria_id' => 1, 'nilai' => 25, 'date' => '2025-02-20'],
            ['kurir_id' => 4, 'kriteria_id' => 2, 'nilai' => 1, 'date' =>' 2025-01-01', ],
            ['kurir_id' => 4, 'kriteria_id' => 3, 'nilai' => 111, 'date' => '2025-02-20'],
            ['kurir_id' => 4, 'kriteria_id' => 4, 'nilai' => 55, 'date' => '2025-02-20'],
            ['kurir_id' => 4, 'kriteria_id' => 5, 'nilai' => 11, 'date' => '2025-02-20'],


        ]);
    }
}
