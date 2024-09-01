<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', 'aktif')->get();
        $id_tahun_ajaran = $tahunAjaran->first()->id_tahun_ajaran;
        $kegiatan = Kegiatan::with('tahunAjaran')->where('id_tahun_ajaran', $id_tahun_ajaran)->get();
        return view('module.kegiatan.wrapper', compact('kegiatan','id_tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'penanggung_jawab' => 'required|string|max:255',
            'periode' => 'required|in:Mingguan,Bulanan,Tahunan',
            'tanggal_pelaksanaan' => 'required|date',
        ]);
        try {
            Kegiatan::create($request->all());
            return response()->json(['message' => 'Data berhasil ditambahkan'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::with('tahunAjaran')->findOrFail($id);
        return response()->json($kegiatan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'penanggung_jawab' => 'required|string|max:255',
            'periode' => 'required|in:Mingguan,Bulanan,Tahunan',
            'tanggal_pelaksanaan' => 'required|date',
        ]);

        try {
            $kegiatan = Kegiatan::findOrFail($id);
            $kegiatan->update($validatedData);
            return response()->json(['message' => 'Data berhasil diperbarui'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);
            $kegiatan->delete();
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function getKegiatan($id)
    {
        $kegiatan = Kegiatan::with('tahunAjaran')->findOrFail($id);
        return response()->json($kegiatan);
    }
    public function getAllKegiatan()
    {
        $kegiatan = Kegiatan::with('tahunAjaran')->get();
        return response()->json($kegiatan);
    }
}
