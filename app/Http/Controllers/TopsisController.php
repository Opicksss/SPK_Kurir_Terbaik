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
    // 1. Konversi nilai asli ke bobot subkriteria
    private function convertToSubKriteria($nilai, $kriteriaId)
    {
        // Tahap: Konversi nilai ke bobot subkriteria sesuai rentang
        $sub = SubKriteria::where('kriteria_id', $kriteriaId)
            ->where('min_value', '<=', $nilai)
            ->where('max_value', '>=', $nilai)
            ->first();

        return $sub ? $sub->bobot : SubKriteria::where('kriteria_id', $kriteriaId)
            ->orderByRaw('ABS(min_value - ?)', [$nilai])
            ->first()?->bobot ?? 0;
    }

    // 2. Ambil total nilai untuk setiap kurir dan kriteria
    private function getTotalNilai($rekaps, $kurirId, $kriteriaId)
    {
        // Tahap: Agregasi nilai (khusus masa kerja ambil bulan terakhir)
        $kriteria = Kriteria::find($kriteriaId);
        if (strtolower($kriteria->nama) === 'masa kerja') {
            return $rekaps->where('kurir_id', $kurirId)
                ->where('kriteria_id', $kriteriaId)
                ->sortByDesc('date')
                ->first()?->nilai ?? 0;
        }
        return $rekaps->where('kurir_id', $kurirId)
            ->where('kriteria_id', $kriteriaId)
            ->sum('nilai');
    }

    // 3. Ambil opsi periode penilaian
    private function getPeriodOptions()
    {
        // Tahap: Menyusun daftar periode penilaian
        return Rekap::selectRaw('YEAR(date) as tahun,
            CASE WHEN MONTH(date) BETWEEN 1 AND 6 THEN 1 ELSE 2 END as periode')
            ->groupBy('tahun', 'periode')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'asc')
            ->get()
            ->map(fn($row) => [
                'tahun' => $row->tahun,
                'periode' => $row->periode,
                'label' => ($row->periode == 1 ? 'Januari–Juni' : 'Juli–Desember') . ' ' . $row->tahun,
                'value' => $row->tahun . '-' . $row->periode
            ]);
    }

    // 4. Ambil data rekap sesuai periode
    private function getRekaps($tahun, $periode)
    {
        // Tahap: Filter data rekap berdasarkan tahun dan semester
        $bulanPeriode = $periode == 1 ? [1, 2, 3, 4, 5, 6] : [7, 8, 9, 10, 11, 12];
        return Rekap::whereYear('date', $tahun)
            ->whereIn(DB::raw('MONTH(date)'), $bulanPeriode)
            ->get();
    }

    // 5. Cek kelengkapan data (minimal 6 bulan)
    private function isDataLengkap($rekaps)
    {
        // Tahap: Validasi kelengkapan data penilaian
        return $rekaps->pluck('date')
            ->map(fn($d) => date('n', strtotime($d)))
            ->unique()
            ->count() >= 6;
    }

    // 6. Ambil kurir yang memiliki rekap di periode tersebut
    private function getKurirsFromRekaps($rekaps)
    {
        // Tahap: Filter kurir yang dinilai pada periode
        $kurirIds = $rekaps->pluck('kurir_id')->unique();
        return Kurir::whereIn('id', $kurirIds)->get();
    }

    // 7. Bangun matriks penilaian (nilai asli dan nilai subkriteria)
    private function buildMatrix($kurirs, $kriterias, $rekaps)
    {
        // Tahap: Matriks keputusan (X) dan matriks bobot subkriteria
        $nilaiAsliMatrix = [];
        $nilaiMatrix = [];
        foreach ($kurirs as $kurir) {
            foreach ($kriterias as $kriteria) {
                $total = $this->getTotalNilai($rekaps, $kurir->id, $kriteria->id);
                $nilaiAsliMatrix[$kurir->id][$kriteria->id] = $total;
                // Cast ke integer agar hasilnya tidak desimal
                $nilaiMatrix[$kurir->id][$kriteria->id] = $total > 0 ? (int) $this->convertToSubKriteria($total, $kriteria->id) : 0;
            }
        }
        return [$nilaiAsliMatrix, $nilaiMatrix];
    }

    // 8. Normalisasi matriks
    private function normalisasiMatrix($nilaiMatrix, $kriterias)
    {
        // Tahap: Normalisasi matriks keputusan
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
        return $normalisasi;
    }

    // 9. Matriks terbobot
    private function matriksTerbobot($normalisasi, $kriterias)
    {
        // Tahap: Matriks normalisasi terbobot (mengalikan bobot kriteria)
        $totalBobot = max(1, (float) $kriterias->sum('bobot'));
        $terbobot = [];
        foreach ($normalisasi as $kurirId => $kriteriaVals) {
            foreach ($kriterias as $kriteria) {
                $id = $kriteria->id;
                $bobot = (float) $kriteria->bobot / $totalBobot;
                $terbobot[$kurirId][$id] = $normalisasi[$kurirId][$id] * $bobot;
            }
        }
        return $terbobot;
    }

    // 10. Solusi ideal positif dan negatif
    private function solusiIdeal($terbobot, $kriterias)
    {
        // Tahap: Menentukan solusi ideal positif (A+) dan negatif (A-)
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
        return [$A_plus, $A_minus];
    }

    // 11. Hitung jarak ke solusi ideal
    private function jarakSolusiIdeal($terbobot, $kriterias, $A_plus, $A_minus)
    {
        // Tahap: Menghitung jarak setiap alternatif ke solusi ideal
        $D_plus = [];
        $D_minus = [];
        foreach ($terbobot as $kurirId => $kriteriaVals) {
            $sumPlus = 0;
            $sumMinus = 0;
            foreach ($kriterias as $kriteria) {
                $id = $kriteria->id;
                $v = $kriteriaVals[$id] ?? 0;
                $sumPlus += pow(($A_plus[$id] ?? 0) - $v, 2);
                $sumMinus += pow($v - ($A_minus[$id] ?? 0), 2);
            }
            $D_plus[$kurirId] = sqrt($sumPlus);
            $D_minus[$kurirId] = sqrt($sumMinus);
        }
        return [$D_plus, $D_minus];
    }

    // 12. Hitung nilai preferensi (V)
    private function nilaiPreferensi($kurirs, $D_plus, $D_minus)
    {
        // Tahap: Menghitung nilai preferensi TOPSIS untuk setiap kurir
        $V = [];
        foreach ($kurirs as $kurir) {
            $plus = $D_plus[$kurir->id] ?? 0;
            $minus = $D_minus[$kurir->id] ?? 0;
            $V[$kurir->id] = $plus + $minus != 0 ? $minus / ($plus + $minus) : 0;
        }
        return $V;
    }

    // 13. Simpan dan urutkan ranking hasil TOPSIS
    private function simpanRanking($V, $tahun, $periode)
    {
        // Tahap: Simpan hasil ranking ke database
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
        return $ranking;
    }

    // 14. Controller utama: proses seluruh tahap di atas
    public function index(Request $request)
    {
        // Tahap: Orkestrasi proses TOPSIS dari input periode sampai hasil ranking
        $periodOptions = $this->getPeriodOptions();
        $selected = $request->input('periode_tahun');
        $tahun = $periode = null;

        $rekaps = collect();
        $kriterias = collect();
        $kurirs = collect();
        $nilaiAsliMatrix = $nilaiMatrix = $normalisasi = $terbobot = [];
        $A_plus = $A_minus = $D_plus = $D_minus = $V = $ranking = [];
        $dataLengkap = true;

        if ($selected) {
            [$tahun, $periode] = explode('-', $selected);
            $rekaps = $this->getRekaps($tahun, $periode);
            $dataLengkap = $this->isDataLengkap($rekaps);

            if ($dataLengkap) {
                $kriterias = Kriteria::all();
                $kurirs = $this->getKurirsFromRekaps($rekaps);

                [$nilaiAsliMatrix, $nilaiMatrix] = $this->buildMatrix($kurirs, $kriterias, $rekaps);
                $normalisasi = $this->normalisasiMatrix($nilaiMatrix, $kriterias);
                $terbobot = $this->matriksTerbobot($normalisasi, $kriterias);
                [$A_plus, $A_minus] = $this->solusiIdeal($terbobot, $kriterias);
                [$D_plus, $D_minus] = $this->jarakSolusiIdeal($terbobot, $kriterias, $A_plus, $A_minus);
                $V = $this->nilaiPreferensi($kurirs, $D_plus, $D_minus);
                $ranking = $this->simpanRanking($V, $tahun, $periode);
            }
        }

        return view('topsis.index', compact(
            'tahun',
            'periode',
            'kriterias',
            'kurirs',
            'nilaiAsliMatrix',
            'nilaiMatrix',
            'normalisasi',
            'terbobot',
            'A_plus',
            'A_minus',
            'D_plus',
            'D_minus',
            'V',
            'ranking',
            'periodOptions',
            'selected',
            'dataLengkap'
        ));
    }
}
