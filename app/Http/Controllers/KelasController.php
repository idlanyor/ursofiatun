<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKelas = Kelas::with('tahunAjaran')->whereRelation('tahunAjaran', 'status', 'aktif')->get();
        $jumlahSantriPerKelas = Santri::with('kelas')->get()->groupBy('id_kelas')->mapWithKeys(function ($group) {
            return [$group->first()->id_kelas => $group->count()];
        });

        $tahunAjaran = TahunAjaran::where('status', 'aktif')->get();
        return view('module.kelas.index', compact('dataKelas', 'tahunAjaran', 'jumlahSantriPerKelas'));
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:255',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Kelas::create($validator->validated());

        return response()->json(['message' => 'Data Kelas berhasil ditambahkan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelas = Kelas::with('tahunAjaran')->findOrFail($id);
        return response()->json($kelas);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::with('tahunAjaran')->findOrFail($id);
        $tahunAjaran = TahunAjaran::all();
        return response()->json(compact('kelas', 'tahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:255',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->update($validator->validated());
            return response()->json(['success' => 'Data Kelas berhasil diperbarui.']);
        } catch (\Exception $e) {
            Log::error('Error updating kelas: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();
            return response()->json(['success' => 'Data Kelas berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting kelas: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data kelas.'], 500);
        }
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
