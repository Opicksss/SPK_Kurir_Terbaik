<?php

namespace App\Http\Controllers;

use App\Models\hasilTopsis;
use App\Models\Kriteria;
use App\Models\Kurir;
use App\Models\Rekap;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $terbaik = hasilTopsis::with('kurir')->where('tahun', 2025)->where('periode', 1)->orderBy('ranking', 'asc')->first();

        return view('dashboard.dashboard', compact('kriteria', 'subKriteria', 'kurir', 'rekap', 'totalKriteria', 'totalKurir', 'totalRekap', 'totalSubKriteria', 'terbaik'));
    }
}
