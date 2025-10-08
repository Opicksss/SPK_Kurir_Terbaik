<?php

namespace App\Http\Controllers;

use App\Models\hasilTopsis;
use Illuminate\Http\Request;
use App\Models\Kurir;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Rekap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopsisController extends Controller
{
    /**
     * Konversi total nilai aktual ke bobot SubKriteria
     */
    private function convertToSubKriteria($nilai, $kriteriaId)
    {
        $sub = SubKriteria::where('kriteria_id', $kriteriaId)->where('min_value', '<=', $nilai)->where('max_value', '>=', $nilai)->first();

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
        return $rekaps->where('kurir_id', $kurirId)->where('kriteria_id', $kriteriaId)->sum('nilai');
    }

    /**
     * Tahapan utama TOPSIS
     */
    public function index(Request $request)
    {
        // === STEP 0: Pilih tahun & periode ===
        $tahun = $request->input('tahun', date('Y'));
        $periode = $request->input('periode', 1); // 1 = Jan–Jun, 2 = Jul–Des
        $bulanPeriode = $periode == 1 ? [1, 2, 3, 4, 5, 6] : [7, 8, 9, 10, 11, 12];

        // === STEP 1: Ambil data dasar ===
        $kriterias = Kriteria::all();
        $kurirs = Kurir::all();
        $rekaps = Rekap::whereYear('date', $tahun)->whereIn(DB::raw('MONTH(date)'), $bulanPeriode)->get();

        // === STEP 2: Buat matriks nilai (X) ===
        $nilaiMatrix = [];
        $nilaiAsliMatrix = [];

        foreach ($kurirs as $kurir) {
            foreach ($kriterias as $kriteria) {
                $total = $this->getTotalNilai($rekaps, $kurir->id, $kriteria->id);
                $nilaiAsliMatrix[$kurir->id][$kriteria->id] = $total;
                $nilaiMatrix[$kurir->id][$kriteria->id] = $total > 0 ? $this->convertToSubKriteria($total, $kriteria->id) : 0;
            }
        }

        // === STEP 3: Normalisasi matriks (R) ===
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $pembagi[$kriteria->id] = sqrt(array_sum(array_map(fn($kurir) => pow($kurir[$kriteria->id] ?? 0, 2), $nilaiMatrix)));
        }

        $normalisasi = [];
        foreach ($nilaiMatrix as $kurirId => $kriteriaVals) {
            foreach ($kriterias as $kriteria) {
                $id = $kriteria->id;
                $normalisasi[$kurirId][$id] = $pembagi[$id] != 0 ? $kriteriaVals[$id] / $pembagi[$id] : 0;
            }
        }

        // 🔍 DEBUG: tampilkan hasil normalisasi
        Log::info('=== DEBUG: NORMALISASI ===');
        foreach ($normalisasi as $kurirId => $vals) {
            Log::info("Kurir {$kurirId}:", $vals);
        }

        // === STEP 4: Matriks Terbobot (Y = R * W) ===
        // Normalisasi bobot agar total = 1, seperti di Excel

        $totalBobot = max(1, (float) $kriterias->sum('bobot'));
        $terbobot = [];

        foreach ($normalisasi as $kurirId => $kriteriaVals) {
            foreach ($kriterias as $kriteria) {
                $id = $kriteria->id;
                $bobot = (float) $kriteria->bobot / $totalBobot; // ← normalisasi bobot
                $terbobot[$kurirId][$id] = $normalisasi[$kurirId][$id] * $bobot;
            }
        }

        // 🔍 Debug
        Log::info('=== DEBUG: TERBOBOT ===');
        foreach ($terbobot as $kurirId => $vals) {
            Log::info("Kurir {$kurirId}:", $vals);
        }

        // === STEP 5: Solusi Ideal Positif & Negatif ===
        $A_plus = [];
        $A_minus = [];
        foreach ($kriterias as $kriteria) {
            $id = $kriteria->id;
            $values = array_column($terbobot, $id);
            if (strtolower($kriteria->sifat) === 'cost') {
                $A_plus[$id] = min($values);
                $A_minus[$id] = max($values);
            } else {
                $A_plus[$id] = max($values);
                $A_minus[$id] = min($values);
            }
        }

        Log::info('=== DEBUG: A_PLUS ===', $A_plus);
        Log::info('=== DEBUG: A_MINUS ===', $A_minus);

        // === STEP 6: Hitung jarak ke solusi ideal (D+ dan D-) ===
        $D_plus = [];
        $D_minus = [];

        foreach ($terbobot as $kurirId => $kriteriaVals) {
            $sumPlus = 0;
            $sumMinus = 0;
            foreach ($kriterias as $kriteria) {
                $id = $kriteria->id;
                $v = $kriteriaVals[$id] ?? 0;
                $aPlus = $A_plus[$id] ?? 0;
                $aMinus = $A_minus[$id] ?? 0;

                $sumPlus += pow($aPlus - $v, 2);
                $sumMinus += pow($v - $aMinus, 2);
            }
            $D_plus[$kurirId] = sqrt($sumPlus);
            $D_minus[$kurirId] = sqrt($sumMinus);
        }

        Log::info('=== DEBUG: D_PLUS ===', $D_plus);
        Log::info('=== DEBUG: D_MINUS ===', $D_minus);

        // === STEP 7: Nilai Preferensi (V) ===
        $V = [];
        foreach ($kurirs as $kurir) {
            $plus = $D_plus[$kurir->id] ?? 0;
            $minus = $D_minus[$kurir->id] ?? 0;
            $V[$kurir->id] = $plus + $minus != 0 ? $minus / ($plus + $minus) : 0;
        }

        // === STEP 8: Ranking ===
        $ranking = collect($V)->sortDesc();

        hasilTopsis::where('tahun', $tahun)->where('periode', $periode)->delete();
        $rank = 1;
        foreach ($ranking as $kurirId => $nilaiV) {
            HasilTopsis::create([
                'kurir_id' => $kurirId,
                'tahun' => $tahun,
                'periode' => $periode,
                'nilai_preferensi' => round($nilaiV, 4),
                'ranking' => $rank++,
            ]);
        }

        // === STEP 9: Kirim ke View ===
        return view('topsis.index', compact('tahun', 'periode', 'kriterias', 'kurirs', 'nilaiAsliMatrix', 'nilaiMatrix', 'normalisasi', 'terbobot', 'A_plus', 'A_minus', 'D_plus', 'D_minus', 'V', 'ranking'));
    }
}
