<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTahunAjaran = TahunAjaran::all();
        return view('module.tahunajaran.index', compact('dataTahunAjaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.tahunajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_mulai' => 'required|integer',
            'tahun_akhir' => 'required|integer',
            'status' => 'required|string|in:aktif,tidak aktif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        TahunAjaran::create($validator->validated());

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(TahunAjaran::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tahunAjaran = TahunAjaran::find($id);
        if (!$tahunAjaran) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($tahunAjaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'tahun_mulai' => 'required|integer',
            'tahun_akhir' => 'required|integer',
            'status' => 'required|string|in:aktif,tidak aktif',
        ]);

        try {
            $tahunAjaran->update($request->only(['tahun_mulai', 'tahun_akhir', 'status']));

            return response()->json(['success' => 'Data tahun ajaran berhasil diupdate.']);
        } catch (\Exception $e) {
            Log::error('Error updating tahun ajaran: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tahunAjaran = TahunAjaran::find($id);
            $tahunAjaran->delete();
            return response()->json(['success' => 'Data tahun ajaran berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting tahun ajaran: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data tahun ajaran.'], 500);
        }
    }

    /**
     * Delete all records from the tahun ajaran table.
     */
    public function deleteAll()
    {
        try {
            TahunAjaran::truncate();
            return response()->json(['success' => 'Semua data tahun ajaran berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting all tahun ajaran: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus semua data tahun ajaran.'], 500);
        }
    }
}
