<?php

namespace App\Http\Controllers;

use App\Models\hasilTopsis;
use App\Models\Rekap;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Ambil opsi periode penilaian (copy dari TopsisController)
    private function getPeriodOptions()
    {
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

    public function index(Request $request)
    {
        $periodOptions = $this->getPeriodOptions();
        $selected = $request->input('periode_tahun');
        $hasil = null;

        if ($selected) {
            [$tahun, $periode] = explode('-', $selected);
            $hasil = hasilTopsis::with('kurir')
                ->where('tahun', $tahun)
                ->where('periode', $periode) // Periode tetap 6 bulan
                ->orderBy('ranking')
                ->get();

            if ($hasil->isEmpty()) {
                $hasil = null;
            }
        }

        return view('home.home', compact('hasil', 'periodOptions', 'selected'));
    }
}
