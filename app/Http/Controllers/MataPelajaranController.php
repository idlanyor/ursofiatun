<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        $dataMapel = MataPelajaran::with(['guru', 'kelas'])->paginate(10);
        return view('module.mapel.index', compact('dataMapel', 'guru', 'kelas'));
    }

    public function create()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        return view('module.mapel.create', compact('guru', 'kelas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|string|max:255',
            'nama_mapel' => 'required|string|max:255',
            'guru_id' => 'required|integer|exists:guru,id_guru',
            'kelas_id' => 'required|integer|exists:kelas,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        MataPelajaran::create($validator->validated());

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    public function show(MataPelajaran $mataPelajaran)
    {
        return view('module.mapel.show', compact('mataPelajaran'));
    }

    public function edit()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        return view('module.mapel.edit', compact( 'guru', 'kelas'));
    }

    public function update(Request $request,$id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->update($request->validate([
            'kode_mapel' => 'required|string|max:255',
            'nama_mapel' => 'required|string|max:255',
            'guru_id' => 'required|integer',
            'kelas_id' => 'required|integer',
        ]));
        return redirect()->route('matapelajaran.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        try {
            $mataPelajaran->delete();
            return response()->json(['success' => 'Data mapel berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting mapel: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data mapel.'], 500);
        }
    }

    public function getAllMapel(){
        $mapel = MataPelajaran::with('guru', 'kelas')->get();
        return response()->json($mapel);
    }
}
