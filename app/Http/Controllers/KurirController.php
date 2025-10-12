<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use App\Models\Rekap;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurirs = Kurir::all();
        return view('kurir.kurir', compact('kurirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'nomor' => 'nullable|string|max:20',
                'tanggal_masuk' => 'required|date',
            ]);

            $lastNumber = Kurir::count() + 1;
            $validated['kode'] = 'KR' . $lastNumber;

            Kurir::create($validated);
            return redirect()->back()->with('success', 'Kurir berhasil di tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Kurir. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurir $kurir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurir $kurir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurir $kurir)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'nomor' => 'nullable|string|max:20',
                'tanggal_masuk' => 'required|date',
            ]);

            $oldTanggalMasuk = $kurir->tanggal_masuk;
            $kurir->update($validated);

            // Update masa kerja di rekap jika tanggal_masuk berubah
            if (strtolower($oldTanggalMasuk) !== strtolower($validated['tanggal_masuk'])) {
                $this->updateMasaKerjaRekap($kurir->id, $oldTanggalMasuk, $validated['tanggal_masuk']);
            }

            return redirect()->back()->with('success', 'Kurir berhasil di update');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate Kurir. Silakan coba lagi.');
        }
    }

    /**
     * Update masa kerja di tabel rekap berdasarkan perubahan tanggal_masuk kurir.
     */
    private function updateMasaKerjaRekap($kurirId, $oldTanggalMasuk, $newTanggalMasuk)
    {
        // Ambil semua rekap untuk kurir ini yang punya kriteria masa kerja (case-insensitive)
        $masaKerjaKriteria = Kriteria::whereRaw('LOWER(nama) = ?', ['masa kerja'])->first();

        if (!$masaKerjaKriteria) {
            return;
        }

        $rekaps = Rekap::where('kurir_id', $kurirId)
            ->where('kriteria_id', $masaKerjaKriteria->id)
            ->get();

        foreach ($rekaps as $rekap) {
            // Hitung masa kerja baru berdasarkan tanggal_masuk yang baru
            $dateRekap = $rekap->date;
            $masaKerjaBaru = $this->hitungMasaKerja($newTanggalMasuk, $dateRekap);

            // Update nilai masa kerja di rekap
            $rekap->update(['nilai' => $masaKerjaBaru]);
        }
    }

    /**
     * Hitung masa kerja (dalam tahun, dibulatkan ke bawah) dari tanggal masuk ke tanggal rekap.
     */
    private function hitungMasaKerja($tanggalMasuk, $tanggalRekap)
    {
        $masuk = new \DateTime($tanggalMasuk);
        $rekap = new \DateTime($tanggalRekap);
        $interval = $masuk->diff($rekap);
        return $interval->y; // tahun
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurir $kurir)
    {
        try {
            $deletedNumber = (int) str_replace('KR', '', $kurir->kode);

            // Hapus data
            $kurir->delete();

            // Ambil semua data setelah kode yang dihapus
            $updateKode = Kurir::whereRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED) > ?', [$deletedNumber])
                                             ->orderByRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED)')
                                             ->get();

            // Update ulang kode-kode setelahnya
            foreach ($updateKode as $item) {
                $currentNumber = (int) str_replace('KR', '', $item->kode);
                $newNumber = $currentNumber - 1;
                $item->update(['kode' => 'KR' . $newNumber]);
            }

            return redirect()->back()->with('success', 'Kurir berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus Kurir. Silakan coba lagi.');
        }
    }
}
