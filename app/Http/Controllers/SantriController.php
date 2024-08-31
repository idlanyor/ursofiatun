<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan eager loading untuk menghindari N+1 problem
        $dataSantri = Santri::with('kelas')->paginate(10);
        $kelas = Kelas::all();
        // dd($dataSantri);
        return view('module.santri.index', compact('dataSantri', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menggunakan eager loading untuk menghindari N+1 problem
        $dataKelas = Kelas::with('tahunAjaran')->get();
        return view('module.santri.create', compact('dataKelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'orang_tua' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Santri::create($validator->validated());

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Santri $santri)
    {
        return response()->json($santri);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        return response()->json($santri);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'orang_tua' => 'nullable|string',
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:15',
        ]);

        try {
            $santri->update([
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => Carbon::parse($request->tanggal_lahir)->format('Y-m-d'),
                'jenis_kelamin' => $request->jenis_kelamin,
                'orang_tua' => $request->orang_tua,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            return response()->json(['success' => 'Data santri berhasil diupdate.']);
        } catch (\Exception $e) {
            Log::error('Error updating santri: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $santri = Santri::findOrFail($id);
            $santri->delete();
            return response()->json(['success' => 'Data santri berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting santri: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data santri.'], 500);
        }
    }
}
