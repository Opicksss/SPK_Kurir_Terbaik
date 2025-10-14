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
        $data = [
            // Kurir 1
            [
                'kurir_id' => 1,
                'masa_kerja' => 1,
                // Bulan 1-6 dan 7-12 dibedakan
                'keterlambatan' => [0, 1, 2, 1, 0, 1, 3, 4, 3, 4, 3, 4],
                'trip_ojek'     => [10, 12, 15, 13, 11, 14, 20, 22, 21, 23, 21, 24],
                'trip_barang'   => [20, 22, 25, 23, 21, 24, 30, 32, 31, 33, 31, 34],
                'kesalahan'     => [1, 2, 1, 2, 1, 2, 3, 2, 3, 2, 3, 2],
            ],
            // Kurir 2
            [
                'kurir_id' => 2,
                'masa_kerja' => 1,
                'keterlambatan' => [3, 2, 1, 0, 1, 2, 5, 6, 5, 6, 5, 6],
                'trip_ojek'     => [30, 32, 35, 33, 31, 34, 40, 42, 41, 43, 41, 44],
                'trip_barang'   => [40, 42, 45, 43, 41, 44, 50, 52, 51, 53, 51, 54],
                'kesalahan'     => [2, 1, 2, 1, 2, 1, 4, 5, 4, 5, 4, 5],
            ],
            // Kurir 3
            [
                'kurir_id' => 3,
                'masa_kerja' => 1,
                'keterlambatan' => [5, 4, 3, 2, 1, 0, 7, 8, 7, 8, 7, 8],
                'trip_ojek'     => [50, 52, 55, 53, 51, 54, 60, 62, 61, 63, 61, 64],
                'trip_barang'   => [60, 62, 65, 63, 61, 64, 70, 72, 71, 73, 71, 74],
                'kesalahan'     => [3, 2, 3, 2, 3, 2, 6, 7, 6, 7, 6, 7],
            ],
            // Kurir 4
            [
                'kurir_id' => 4,
                'masa_kerja' => 2,
                'keterlambatan' => [6, 7, 8, 7, 6, 7, 9, 10, 9, 10, 9, 10],
                'trip_ojek'     => [70, 72, 75, 73, 71, 74, 80, 82, 81, 83, 81, 84],
                'trip_barang'   => [80, 82, 85, 83, 81, 84, 90, 92, 91, 93, 91, 94],
                'kesalahan'     => [4, 5, 4, 5, 4, 5, 8, 9, 8, 9, 8, 9],
            ],
        ];

        $dates = [];
        for ($m = 1; $m <= 12; $m++) {
            $dates[] = '2025-' . str_pad($m, 2, '0', STR_PAD_LEFT) . '-01';
        }

        $insert = [];
        foreach ($data as $kurir) {
            foreach ($dates as $i => $date) {
                $insert[] = ['kurir_id' => $kurir['kurir_id'], 'kriteria_id' => 1, 'nilai' => $kurir['keterlambatan'][$i], 'date' => $date];
                $insert[] = ['kurir_id' => $kurir['kurir_id'], 'kriteria_id' => 2, 'nilai' => $kurir['masa_kerja'], 'date' => $date];
                $insert[] = ['kurir_id' => $kurir['kurir_id'], 'kriteria_id' => 3, 'nilai' => $kurir['trip_ojek'][$i], 'date' => $date];
                $insert[] = ['kurir_id' => $kurir['kurir_id'], 'kriteria_id' => 4, 'nilai' => $kurir['trip_barang'][$i], 'date' => $date];
                $insert[] = ['kurir_id' => $kurir['kurir_id'], 'kriteria_id' => 5, 'nilai' => $kurir['kesalahan'][$i], 'date' => $date];
            }
        }

        DB::table('rekaps')->insert($insert);
    }
}
