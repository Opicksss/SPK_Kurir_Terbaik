<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
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
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $lastNumber = Kurir::count() + 1;
            $validatedData['kode'] = 'KR' . $lastNumber;

            Kurir::create($validatedData);
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
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $kurir->update($validatedData);
            return redirect()->back()->with('success', 'Kurir berhasil di update');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate Kurir. Silakan coba lagi.');
        }
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
