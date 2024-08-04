<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSantri = Santri::all();
        return view('module.santri.index', compact('dataSantri'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.santri.create');
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
    public function show(Santri $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        return response()->json($santri);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'orang_tua' => 'required',
            'telepon' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        try {
            $santri = Santri::find($id);
            if ($santri) {
                $santri->update([
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => Carbon::parse($request->tanggal_lahir)->format('Y-m-d'),
                    'orang_tua' => $request->orang_tua,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                ]);

                return response()->json(['success' => 'Data santri berhasil diupdate.']);
            } else {
                return response()->json(['error' => 'Santri not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error updating santri: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Santri $santri)
    {
        try {
            $santri->delete();
            return response()->json(['success' => 'Data santri berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data santri.'], 500);
        }
    }
}
