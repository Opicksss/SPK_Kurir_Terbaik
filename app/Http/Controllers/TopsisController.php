<?php

namespace App\Http\Controllers;

use App\Models\HasilTopsis;
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
        // Ambil daftar tahun+periode dari data rekap
        $rekapPeriods = Rekap::selectRaw('YEAR(date) as tahun,
            CASE
                WHEN MONTH(date) BETWEEN 1 AND 6 THEN 1
                ELSE 2
            END as periode')
            ->groupBy('tahun', 'periode')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'asc')
            ->get();

        // Gabungkan jadi satu array untuk select
        $periodOptions = $rekapPeriods->map(function($row) {
            $label = ($row->periode == 1 ? 'Januari–Juni' : 'Juli–Desember') . ' ' . $row->tahun;
            return [
                'tahun' => $row->tahun,
                'periode' => $row->periode,
                'label' => $label,
                'value' => $row->tahun . '-' . $row->periode
            ];
        });

        // Ambil pilihan dari request
        $selected = $request->input('periode_tahun'); // Jangan isi default
        $tahun = null;
        $periode = null;
        if ($selected) {
            [$tahun, $periode] = explode('-', $selected);
            $bulanPeriode = $periode == 1 ? [1,2,3,4,5,6] : [7,8,9,10,11,12];
            $rekaps = Rekap::whereYear('date', $tahun)->whereIn(DB::raw('MONTH(date)'), $bulanPeriode)->get();

            // Cek jumlah bulan unik
            $bulanTersedia = $rekaps->pluck('date')->map(fn($d) => date('n', strtotime($d)))->unique()->count();
            $dataLengkap = $bulanTersedia >= 6;

            if (!$dataLengkap) {
                // Kosongkan data agar tidak diproses
                $kriterias = Kriteria::all();
                $kurirs = Kurir::all();
                $nilaiAsliMatrix = [];
                $nilaiMatrix = [];
                $normalisasi = [];
                $terbobot = [];
                $A_plus = [];
                $A_minus = [];
                $D_plus = [];
                $D_minus = [];
                $V = [];
                $ranking = [];
            } else {
                // === STEP 1: Ambil data dasar ===
                $kriterias = Kriteria::all();
                $kurirs = Kurir::all();

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


                // === STEP 7: Nilai Preferensi (V) ===
                $V = [];
                foreach ($kurirs as $kurir) {
                    $plus = $D_plus[$kurir->id] ?? 0;
                    $minus = $D_minus[$kurir->id] ?? 0;
                    $V[$kurir->id] = $plus + $minus != 0 ? $minus / ($plus + $minus) : 0;
                }

                // === STEP 8: Ranking ===
                $ranking = collect($V)->sortDesc();

                $rank = 1;
                foreach ($ranking as $kurirId => $nilaiV) {
                    HasilTopsis::updateOrCreate(
                        [
                            'kurir_id' => $kurirId,
                            'tahun' => $tahun,
                            'periode' => $periode,
                        ],
                        [
                            'nilai_preferensi' => round($nilaiV, 4),
                            'ranking' => $rank++,
                        ]
                    );
                }
            }
        } else {
            // Kosongkan semua data yang butuh periode/tahun
            $rekaps = collect();
            $nilaiAsliMatrix = [];
            $nilaiMatrix = [];
            $normalisasi = [];
            $terbobot = [];
            $A_plus = [];
            $A_minus = [];
            $D_plus = [];
            $D_minus = [];
            $V = [];
            $ranking = [];
            $kriterias = collect(); // <-- tambahkan ini
            $kurirs = collect();    // <-- dan ini
            $dataLengkap = true;
        }

        // === STEP 9: Kirim ke View ===
        return view('topsis.index', compact(
            'tahun', 'periode', 'kriterias', 'kurirs', 'nilaiAsliMatrix', 'nilaiMatrix', 'normalisasi', 'terbobot', 'A_plus', 'A_minus', 'D_plus', 'D_minus', 'V', 'ranking',
            'periodOptions', 'selected', 'dataLengkap'
        ));
    }
}
