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
        $rekaps = Rekap::where('kurir_id', $kurir_id)->orderBy('date', 'desc')->get();
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
                'nilai.*' => 'nullable|numeric|min:0',
                'date' => 'required|date',
            ]);

            $kurirId = $request->input('kurir_id');
            $date = $request->input('date');
            $nilaiData = $request->input('nilai');

            $kurir = Kurir::findOrFail($kurirId);

            // Cari kriteria "masa kerja" (case-insensitive)
            $masaKerjaKriteria = Kriteria::whereRaw('LOWER(nama) = ?', ['masa kerja'])->first();
            $masaKerjaKeyExists = $masaKerjaKriteria && array_key_exists($masaKerjaKriteria->id, $nilaiData) && $nilaiData[$masaKerjaKriteria->id] !== null;

            foreach ($nilaiData as $kriteriaId => $nilai) {
                // Jika kriteria masa kerja, hitung otomatis berdasarkan tanggal masuk kurir
                if ($masaKerjaKriteria && (int) $kriteriaId === (int) $masaKerjaKriteria->id) {
                    $nilaiToStore = $this->hitungMasaKerja($kurir->tanggal_masuk, $date);
                } else {
                    // Jika nilai tidak dikirim dari view, lewati
                    if ($nilai === null) {
                        continue;
                    }
                    $nilaiToStore = floor($nilai);
                }

                $exists = Rekap::where('kurir_id', $kurirId)->where('kriteria_id', $kriteriaId)->where('date', $date)->exists();

                if ($exists) {
                    return redirect()
                        ->back()
                        ->with('error', "Data untuk tanggal $date sudah ada. Proses dibatalkan.");
                }

                Rekap::create([
                    'kurir_id' => $kurirId,
                    'kriteria_id' => $kriteriaId,
                    'nilai' => $nilaiToStore,
                    'date' => $date,
                ]);
            }

            // Jika kriteria masa kerja tidak dikirim dari view, tambahkan secara otomatis
            if ($masaKerjaKriteria && !$masaKerjaKeyExists) {
                $kriteriaId = $masaKerjaKriteria->id;
                $nilaiToStore = $this->hitungMasaKerja($kurir->tanggal_masuk, $date);

                $exists = Rekap::where('kurir_id', $kurirId)->where('kriteria_id', $kriteriaId)->where('date', $date)->exists();

                if (!$exists) {
                    Rekap::create([
                        'kurir_id' => $kurirId,
                        'kriteria_id' => $kriteriaId,
                        'nilai' => $nilaiToStore,
                        'date' => $date,
                    ]);
                }
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
                'kurir_id' => 'required|exists:kurirs,id',
                'date' => 'required|date',
                'nilai' => 'required|array',
                'nilai.*' => 'nullable|numeric|min:0',
            ]);

            $rekaps = Rekap::where('date', $id)->where('kurir_id', $request->kurir_id)->get();

            if ($rekaps->isEmpty()) {
                return redirect()->back()->with('error', 'Data rekap tidak ditemukan.');
            }

            $kurirId = $rekaps->first()->kurir_id;
            $kurir = Kurir::findOrFail($kurirId);

            // Cari kriteria "masa kerja" (case-insensitive)
            $masaKerjaKriteria = Kriteria::whereRaw('LOWER(nama) = ?', ['masa kerja'])->first();

            // Cek apakah sudah ada data dengan tanggal yang sama (selain yang sedang diupdate)
            foreach ($request->nilai as $kriteriaId => $nilai) {
                if ($nilai !== null) {
                    $exists = Rekap::where('kurir_id', $kurirId)->where('kriteria_id', $kriteriaId)->where('date', $request->date)->where('date', '!=', $id)->exists();

                    if ($exists) {
                        return redirect()
                            ->back()
                            ->with('error', "Data untuk tanggal {$request->date} sudah ada. Proses update dibatalkan.");
                    }
                }
            }

            DB::transaction(function () use ($request, $id, $kurir, $masaKerjaKriteria) {
                foreach ($request->nilai as $kriteriaId => $nilai) {
                    // Jika kriteria masa kerja, hitung otomatis
                    if ($masaKerjaKriteria && (int) $kriteriaId === (int) $masaKerjaKriteria->id) {
                        $nilaiToStore = $this->hitungMasaKerja($kurir->tanggal_masuk, $request->date);
                    } else {
                        if ($nilai === null) {
                            continue;
                        }
                        $nilaiToStore = floor($nilai);
                    }

                    Rekap::where('date', $id)
                        ->where('kriteria_id', $kriteriaId)
                        ->where('kurir_id', $request->kurir_id)
                        ->update([
                            'nilai' => $nilaiToStore,
                            'date' => $request->date,
                        ]);
                }

                // Jika masa kerja tidak dikirim dari view, update/tambahkan secara otomatis
                if ($masaKerjaKriteria && !array_key_exists($masaKerjaKriteria->id, $request->nilai)) {
                    $kriteriaId = $masaKerjaKriteria->id;
                    $nilaiToStore = $this->hitungMasaKerja($kurir->tanggal_masuk, $request->date);

                    $rekapMasaKerja = Rekap::where('date', $id)->where('kriteria_id', $kriteriaId)->where('kurir_id', $request->kurir_id)->first();

                    if ($rekapMasaKerja) {
                        $rekapMasaKerja->update([
                            'nilai' => $nilaiToStore,
                            'date' => $request->date,
                        ]);
                    } else {
                        Rekap::create([
                            'kurir_id' => $kurir->id,
                            'kriteria_id' => $kriteriaId,
                            'nilai' => $nilaiToStore,
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

    private function hitungMasaKerja($tanggalMasuk, $tanggalRekap)
    {
        $masuk = new \DateTime($tanggalMasuk);
        $rekap = new \DateTime($tanggalRekap);
        $interval = $masuk->diff($rekap);
        return $interval->y; // tahun
    }
}
