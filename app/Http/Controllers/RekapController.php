<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use App\Models\Kriteria;
use App\Models\Kurir;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function detail($kurir_id)
    {
        $rekaps = Rekap::where('kurir_id', $kurir_id)->get();
        $kurir = Kurir::findOrFail($kurir_id);
        $kriterias = Kriteria::all();
        return view('rekap.penilaian', compact('rekaps', 'kurir', 'kriterias'));
    }

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
    public function update(Request $request, Rekap $rekap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekap $rekap)
    {
        //
    }
}
