<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use App\Models\Rekap;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekaps = Rekap::all();
        $kurirs = Kurir::all();
        $kriterias = Kriteria::all();
        return view('rekap.rekap', compact('rekaps', 'kurirs', 'kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function detail($kurir_id)
    {
        $rekaps = Rekap::where('kurir_id', $kurir_id)->orderBy('created_at', 'desc')->get();
        $kurirs = Kurir::findOrFail($kurir_id);
        $kriterias = Kriteria::all();
        return view('rekap.penilaian', compact('rekaps', 'kurirs', 'kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'kurir_id' => 'required|exists:kurirs,id',
                'nilai' => 'required|array',
                'nilai.*' => 'required|numeric|min:0',
                'date' => 'required|date',
            ]);

            $kurirId = $request->input('kurir_id');
            $date = $request->input('date');
            $nilaiData = $request->input('nilai');

            foreach ($nilaiData as $kriteriaId => $nilai) {
                $exists = Rekap::where('kurir_id', $kurirId)->where('kriteria_id', $kriteriaId)->where('date', $date)->exists();

                if ($exists) {
                    return redirect()
                        ->back()
                        ->with('error', "Data untuk tanggal $date sudah ada. Proses dibatalkan.");
                }

                Rekap::create([
                    'kurir_id' => $kurirId,
                    'kriteria_id' => $kriteriaId,
                    'nilai' => floor($nilai),
                    'date' => $date,
                ]);
            }

            return redirect()->back()->with('success', 'Rekap nilai berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan rekap nilai. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekap $rekap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'nilai' => 'required|array',
                'nilai.*' => 'nullable|numeric|min:0',
            ]);

            // Cek apakah sudah ada data dengan tanggal yang sama (selain yang sedang diupdate)
            $exists = Rekap::where('date', $request->date)
                ->where('date', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()
                    ->back()
                    ->with('error', "Data untuk tanggal {$request->date} sudah ada. Proses update dibatalkan.");
            }

            DB::transaction(function () use ($request, $id) {
                foreach ($request->nilai as $kriteriaId => $nilai) {
                    if ($nilai !== null) {
                        Rekap::where('date', $id)
                            ->where('kriteria_id', $kriteriaId)
                            ->update([
                                'nilai' => floor($nilai),
                                'date' => $request->date,
                            ]);
                    }
                }
            });

            return redirect()->back()->with('success', 'Rekap nilai berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Rekap::where('date', $id)->delete();
            return redirect()->back()->with('success', 'Rekap nilai berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus rekap: ' . $e->getMessage());
        }
    }
}
