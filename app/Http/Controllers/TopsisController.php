<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use App\Models\Kurir;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopsisController extends Controller
{
    public function index(Request $request)
    {
        // 🗓️ Ambil rentang tanggal 5 bulan terakhir
        $endDate = $request->input('end_date', now());
        $startDate = \Carbon\Carbon::parse($endDate)->subMonths(5);

        // 1️⃣ Ambil data rekap selama 5 bulan
        $data = Rekap::whereBetween('date', [$startDate, $endDate])
            ->select('kurir_id', 'kriteria_id', DB::raw('AVG(nilai) as rata_nilai'))
            ->groupBy('kurir_id', 'kriteria_id')
            ->get();

        $kurirs = Kurir::all();
        $kriterias = Kriteria::all();

        // Bentuk matriks keputusan
        $matriks = [];
        foreach ($data as $d) {
            $matriks[$d->kurir_id][$d->kriteria_id] = $d->rata_nilai;
        }

        // 2️⃣ Normalisasi (Rij = Xij / sqrt(sum(X²j)))
        $normalisasi = [];
        foreach ($kriterias as $kriteria) {
            $sumKuadrat = 0;
            foreach ($kurirs as $kurir) {
                $nilai = $matriks[$kurir->id][$kriteria->id] ?? 0;
                $sumKuadrat += pow($nilai, 2);
            }

            $pembagi = sqrt($sumKuadrat);
            foreach ($kurirs as $kurir) {
                $nilai = $matriks[$kurir->id][$kriteria->id] ?? 0;
                $normalisasi[$kurir->id][$kriteria->id] = $pembagi > 0 ? $nilai / $pembagi : 0;
            }
        }

        // 3️⃣ Matriks Ternormalisasi Terbobot (Yij = Rij * Wj)
        $terbobot = [];
        foreach ($kurirs as $kurir) {
            foreach ($kriterias as $kriteria) {
                $terbobot[$kurir->id][$kriteria->id] =
                    ($normalisasi[$kurir->id][$kriteria->id] ?? 0) * ($kriteria->bobot / 100);
            }
        }

        // 4️⃣ Solusi ideal positif dan negatif
        $idealPositif = [];
        $idealNegatif = [];

        foreach ($kriterias as $kriteria) {
            $kolom = array_column($terbobot, $kriteria->id);
            if ($kriteria->sifat === 'benefit') {
                $idealPositif[$kriteria->id] = max($kolom);
                $idealNegatif[$kriteria->id] = min($kolom);
            } else {
                $idealPositif[$kriteria->id] = min($kolom);
                $idealNegatif[$kriteria->id] = max($kolom);
            }
        }

        // 5️⃣ Hitung jarak ke solusi ideal positif & negatif
        $jarakPositif = [];
        $jarakNegatif = [];

        foreach ($kurirs as $kurir) {
            $sumPositif = 0;
            $sumNegatif = 0;
            foreach ($kriterias as $kriteria) {
                $yij = $terbobot[$kurir->id][$kriteria->id] ?? 0;
                $sumPositif += pow($yij - $idealPositif[$kriteria->id], 2);
                $sumNegatif += pow($yij - $idealNegatif[$kriteria->id], 2);
            }
            $jarakPositif[$kurir->id] = sqrt($sumPositif);
            $jarakNegatif[$kurir->id] = sqrt($sumNegatif);
        }

        // 6️⃣ Nilai preferensi (Vi = D- / (D+ + D-))
        $preferensi = [];
        foreach ($kurirs as $kurir) {
            $dPlus = $jarakPositif[$kurir->id];
            $dMin = $jarakNegatif[$kurir->id];
            $preferensi[$kurir->id] = ($dPlus + $dMin) > 0 ? $dMin / ($dPlus + $dMin) : 0;
        }

        // 7️⃣ Urutkan ranking
        arsort($preferensi);

        return view('topsis.hasil', compact(
            'preferensi',
            'kurirs',
            'kriterias',
            'startDate',
            'endDate',
            'matriks',
            'normalisasi',
            'terbobot',
            'idealPositif',
            'idealNegatif'
        ));
    }
}
