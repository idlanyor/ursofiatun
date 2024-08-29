<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\MataPelajaran;
use App\Models\Santri;
use Illuminate\Support\Facades\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataNilai = Nilai::with('santri', 'mapel')->get();
        $mapel = MataPelajaran::all();
        $santri = Santri::all();
        return view('module.nilai.nilai-mapel', compact('dataNilai', 'mapel', 'santri'));
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
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}
