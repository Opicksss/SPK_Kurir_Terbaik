<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Rekap;
use Illuminate\Support\Facades\DB;

class TopsisController extends Controller
{
    /**
     * Konversi total nilai aktual ke bobot SubKriteria
     */
    private function convertToSubKriteria($nilai, $kriteriaId)
    {
        $sub = SubKriteria::where('kriteria_id', $kriteriaId)
            ->where('min_value', '<=', $nilai)
            ->where('max_value', '>=', $nilai)
            ->first();

        // Jika tidak ada range yang pas, cari yang paling dekat
        if (!$sub) {
            $sub = SubKriteria::where('kriteria_id', $kriteriaId)
                ->orderByRaw('ABS(min_value - ?)', [$nilai])
                ->first();
        }

        return $sub ? $sub->bobot : 0;
    }

    /**
     * Hitung total nilai rekap per kurir dan kriteria
     */
    private function getTotalNilai($rekaps, $kurirId, $kriteriaId)
    {
        return $rekaps
            ->where('kurir_id', $kurirId)
            ->where('kriteria_id', $kriteriaId)
            ->sum('nilai');
    }

    /**
     * Tahapan utama TOPSIS
     */
    public function index(Request $request)
    {
        // --- STEP 0: Ambil periode & tahun ---
        $tahun = $request->input('tahun', date('Y'));
        $periode = $request->input('periode', 1); // 1 = Jan–Jun, 2 = Jul–Des
        $bulanPeriode = $periode == 1 ? [1,2,3,4,5,6] : [7,8,9,10,11,12];

        // --- STEP 1: Ambil data dasar ---
        $kriterias = Kriteria::all();
        $kurirs = Kurir::all();
        $rekaps = Rekap::whereYear('date', $tahun)
            ->whereIn(DB::raw('MONTH(date)'), $bulanPeriode)
            ->get();

        // --- STEP 2: Buat matriks nilai (Total → Bobot Subkriteria) ---
        $nilaiMatrix = [];
        $nilaiAsliMatrix = [];

        foreach ($kurirs as $kurir) {
            foreach ($kriterias as $kriteria) {
                // Total nilai per kurir & kriteria selama 6 bulan
                $totalNilai = $this->getTotalNilai($rekaps, $kurir->id, $kriteria->id);

                // Simpan nilai asli (untuk tampilan)
                $nilaiAsliMatrix[$kurir->id][$kriteria->id] = $totalNilai;

                // Konversi ke bobot SubKriteria
                $nilaiMatrix[$kurir->id][$kriteria->id] = $totalNilai > 0
                    ? $this->convertToSubKriteria($totalNilai, $kriteria->id)
                    : 0;
            }
        }

        // --- STEP 3: Normalisasi matriks ---
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $pembagi[$kriteria->id] = sqrt(
                array_sum(array_map(
                    fn($kurir) => pow($kurir[$kriteria->id] ?? 0, 2),
                    $nilaiMatrix
                ))
            );
        }

        $normalisasi = [];
        foreach ($nilaiMatrix as $kurirId => $kriteriaVals) {
            foreach ($kriterias as $kriteria) {
                $normalisasi[$kurirId][$kriteria->id] =
                    $pembagi[$kriteria->id] != 0
                        ? $kriteriaVals[$kriteria->id] / $pembagi[$kriteria->id]
                        : 0;
            }
        }

        // --- STEP 4: Matriks Terbobot (R * Bobot) ---
        $totalBobot = max(1, (float) $kriterias->sum('bobot'));
        $terbobot = [];
        foreach ($normalisasi as $kurirId => $kriteriaVals) {
            foreach ($kriterias as $kriteria) {
                $bobotTernormalisasi = (float) $kriteria->bobot / $totalBobot;
                $terbobot[$kurirId][$kriteria->id] =
                    $normalisasi[$kurirId][$kriteria->id] * $bobotTernormalisasi;
            }
        }

        // --- STEP 5: Solusi Ideal Positif & Negatif ---
        $A_plus = [];
        $A_minus = [];
        foreach ($kriterias as $kriteria) {
            $values = array_column($terbobot, $kriteria->id);
            if (strtolower($kriteria->sifat) === 'cost') {
                // cost → ideal positif = min, ideal negatif = max
                $A_plus[$kriteria->id] = min($values);
                $A_minus[$kriteria->id] = max($values);
            } else {
                // benefit → ideal positif = max, ideal negatif = min
                $A_plus[$kriteria->id] = max($values);
                $A_minus[$kriteria->id] = min($values);
            }
        }

        // --- STEP 6: Hitung jarak ke solusi ideal ---
        $D_plus = [];
        $D_minus = [];
        foreach ($terbobot as $kurirId => $kriteriaVals) {
            $D_plus[$kurirId] = sqrt(array_sum(array_map(
                fn($kriteria) => pow(($A_plus[$kriteria->id] - $kriteriaVals[$kriteria->id]), 2),
                $kriterias->all()
            )));
            $D_minus[$kurirId] = sqrt(array_sum(array_map(
                fn($kriteria) => pow(($kriteriaVals[$kriteria->id] - $A_minus[$kriteria->id]), 2),
                $kriterias->all()
            )));
        }

        // --- STEP 7: Nilai Preferensi (V) ---
        $V = [];
        foreach ($kurirs as $kurir) {
            $Dtotal = $D_plus[$kurir->id] + $D_minus[$kurir->id];
            $V[$kurir->id] = $Dtotal != 0 ? $D_minus[$kurir->id] / $Dtotal : 0;
        }

        // --- STEP 8: Ranking ---
        $ranking = collect($V)->sortDesc();

        // --- STEP 9: Kirim ke View ---
        return view('topsis.index', compact(
            'tahun', 'periode', 'kriterias', 'kurirs',
            'nilaiMatrix', 'nilaiAsliMatrix', 'normalisasi', 'terbobot',
            'A_plus', 'A_minus', 'D_plus', 'D_minus', 'V', 'ranking'
        ));
    }
}
