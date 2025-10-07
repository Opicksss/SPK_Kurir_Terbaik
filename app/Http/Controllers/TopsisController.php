<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopsisController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tahun & periode dari user (default tahun sekarang)
        $tahun = $request->input('tahun', date('Y'));
        $periode = $request->input('periode', 1); // 1 = Jan–Jun, 2 = Jul–Des

        $bulanPeriode = $periode == 1
            ? [1, 2, 3, 4, 5, 6]
            : [7, 8, 9, 10, 11, 12];

        // Ambil semua kriteria dan bobotnya
        $kriterias = Kriteria::all();

        // Ambil data rekap berdasarkan periode dan tahun
        $rekaps = Rekap::whereYear('date', $tahun)
            ->whereIn(DB::raw('MONTH(date)'), $bulanPeriode)
            ->get();

        // Ambil semua kurir
        $kurirs = Kurir::all();

        // ===== STEP 1: KONVERSI NILAI KE SUBKRITERIA =====
        $nilaiMatrix = [];
        foreach ($kurirs as $kurir) {
            foreach ($kriterias as $kriteria) {
                $nilai = $rekaps
                    ->where('kurir_id', $kurir->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->avg('nilai'); // rata-rata jika lebih dari satu data

                if ($nilai !== null) {
                    $sub = SubKriteria::where('kriteria_id', $kriteria->id)
                        ->where('min_value', '<=', $nilai)
                        ->where('max_value', '>=', $nilai)
                        ->first();

                    $bobot = $sub ? $sub->bobot : 0;
                    $nilaiMatrix[$kurir->id][$kriteria->id] = $bobot;
                } else {
                    $nilaiMatrix[$kurir->id][$kriteria->id] = 0;
                }
            }
        }

        // ===== STEP 2: NORMALISASI MATRIX =====
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $pembagi[$kriteria->id] = sqrt(array_sum(array_map(function ($kurir) use ($kriteria) {
                return pow($kurir[$kriteria->id] ?? 0, 2);
            }, $nilaiMatrix)));
        }

        $normalisasi = [];
        foreach ($nilaiMatrix as $kurirId => $kriteriaVals) {
            foreach ($kriterias as $kriteria) {
                $normalisasi[$kurirId][$kriteria->id] = $pembagi[$kriteria->id] != 0
                    ? $kriteriaVals[$kriteria->id] / $pembagi[$kriteria->id]
                    : 0;
            }
        }

        // ===== STEP 3: MATRIX TERBOBOT =====
        $terbobot = [];
        foreach ($normalisasi as $kurirId => $kriteriaVals) {
            foreach ($kriterias as $kriteria) {
                $terbobot[$kurirId][$kriteria->id] = $kriteriaVals[$kriteria->id] * $kriteria->bobot;
            }
        }

        // ===== STEP 4: SOLUSI IDEAL =====
        $A_plus = [];
        $A_minus = [];
        foreach ($kriterias as $kriteria) {
            $values = array_column($terbobot, $kriteria->id);
            $A_plus[$kriteria->id] = max($values);
            $A_minus[$kriteria->id] = min($values);
        }

        // ===== STEP 5: JARAK IDEAL =====
        $D_plus = [];
        $D_minus = [];
        foreach ($terbobot as $kurirId => $kriteriaVals) {
            $D_plus[$kurirId] = sqrt(array_sum(array_map(function ($kriteria) use ($kriteriaVals, $A_plus) {
                return pow($A_plus[$kriteria->id] - $kriteriaVals[$kriteria->id], 2);
            }, $kriterias->all())));

            $D_minus[$kurirId] = sqrt(array_sum(array_map(function ($kriteria) use ($kriteriaVals, $A_minus) {
                return pow($kriteriaVals[$kriteria->id] - $A_minus[$kriteria->id], 2);
            }, $kriterias->all())));
        }

        // ===== STEP 6: NILAI PREFERENSI (V) =====
        $V = [];
        foreach ($kurirs as $kurir) {
            $V[$kurir->id] = ($D_plus[$kurir->id] + $D_minus[$kurir->id]) != 0
                ? $D_minus[$kurir->id] / ($D_plus[$kurir->id] + $D_minus[$kurir->id])
                : 0;
        }

        // ===== STEP 7: RANGKING =====
        $ranking = collect($V)->sortDesc();

        return view('topsis.index', compact(
            'kriterias', 'kurirs', 'nilaiMatrix', 'normalisasi', 'terbobot',
            'A_plus', 'A_minus', 'D_plus', 'D_minus', 'V', 'ranking', 'tahun', 'periode'
        ));
    }
}
