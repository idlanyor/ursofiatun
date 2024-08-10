<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKelas = Kelas::with('tahunAjaran')->get();
        $tahunAjaran = TahunAjaran::all();
        return view('module.kelas.index', compact('dataKelas', 'tahunAjaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahunAjaran = TahunAjaran::all();
        return view('module.kelas.create', compact('tahunAjaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        $kelas = Kelas::create($request->validated());
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return view('module.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        $tahunAjaran = TahunAjaran::all();
        return view('module.kelas.edit', compact('kelas', 'tahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        $kelas->update($request->validated());
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    }

    /**
     * Get the specified resource for AJAX requests.
     */
    public function getKelas($id)
    {
        $kelas = Kelas::with('tahunAjaran')->findOrFail($id);
        return response()->json($kelas);
    }
}