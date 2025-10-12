<?php

namespace App\Http\Controllers;

use App\Models\hasilTopsis;
use App\Models\Kriteria;
use App\Models\Kurir;
use App\Models\Rekap;
use App\Models\SubKriteria;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $kriteria = Kriteria::all();
        $subKriteria = SubKriteria::all();
        $kurir = Kurir::all();
        $rekap = Rekap::all();

        // Statistik untuk dashboard
        $totalKriteria = Kriteria::count();
        $totalKurir = Kurir::count();
        $totalRekap = Rekap::count();
        $totalSubKriteria = SubKriteria::count();

        $latest = hasilTopsis::orderByDesc('tahun')
            ->orderByDesc('periode')
            ->first();

        $terbaik = collect();
        if ($latest) {
            $terbaik = hasilTopsis::with('kurir')
            ->where('tahun', $latest->tahun)
            ->where('periode', $latest->periode)
            ->orderBy('ranking', 'asc')
            ->take(3)
            ->get();
        }

        // Hitung sisa data rekap hari ini
        $today = now()->toDateString();
        // Ambil semua kurir yang sudah diisi rekap untuk hari ini (distinct kurir_id)
        $rekapHariIni = Rekap::where('date', $today)->distinct('kurir_id')->pluck('kurir_id');
        $sisaRekapHariIni = $totalKurir - $rekapHariIni->count();

        return view('dashboard.dashboard', compact(
            'kriteria', 'subKriteria', 'kurir', 'rekap',
            'totalKriteria', 'totalKurir', 'totalRekap', 'totalSubKriteria',
            'terbaik', 'sisaRekapHariIni'
        ));
    }
}
