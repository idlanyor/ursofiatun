<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarpras;
use Illuminate\Support\Facades\Validator;

class SarprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSarpras = Sarpras::paginate(10);
        return view('module.sarpras.index', compact('dataSarpras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.sarpras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'tanggal_pengadaan' => 'required|date',
            'kondisi' => 'in:baik,rusak|required',
            'jumlah' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $sarpras = Sarpras::create($validator->validated());
        return response()->json(['message' => 'Data Sarana Prasarana berhasil ditambahkan', 'sarpras' => $sarpras], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sarpras = Sarpras::find($id);
        return response()->json($sarpras);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $sarpras = Sarpras::findOrFail($id);
        return response()->json($sarpras);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_barang' => 'string|max:255',
                'tanggal_pengadaan' => 'date',
                'kondisi' => 'in:baik,rusak',
                'jumlah' => 'integer',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $sarpras = Sarpras::find($id);
            $sarpras->update($validator->validated());
            return response()->json(['message' => 'Data Sarana Prasarana berhasil diperbarui', 'sarpras' => $sarpras], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui data'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $sarpras = Sarpras::findOrFail($id);
            $sarpras->delete();
            return response()->json(['message' => 'Data Sarana Prasarana berhasil dihapus', 'sarpras' => $sarpras], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
