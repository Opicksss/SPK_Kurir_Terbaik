<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('created_at', 'asc')->get();

        return view('kriteria.kriteria', compact('kriteria'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:kriterias,nama',
                'sifat' => 'required|in:benefit,cost',
                'bobot' => 'required|numeric|min:0.01|max:100',
            ]);

            $lastNumber = Kriteria::count() + 1;
            $validated['kode'] = 'C' . $lastNumber;

            Kriteria::create($validated);

            return redirect()->back()->with('success', 'Kriteria created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan Kriteria. Silakan coba lagi.: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);

            // Validasi dasar
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:kriterias,nama,' . $id,
                'sifat' => 'required|in:benefit,cost',
                'bobot' => 'required|numeric|min:0.01|max:100',
            ]);

            $kriteria->update($validated);

            return redirect()->back()->with('success', 'Kriteria berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Kriteria. Silakan coba lagi.' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrfail($id);
        $kriteria->delete();

        return back()->with('success', 'data telah dihapus');
    }


}
