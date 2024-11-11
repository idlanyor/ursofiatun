<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        $kelasList = Kelas::withCount('santri')->get();
        $mapelList = MataPelajaran::all();

        return view('module.nilai.index', compact('kelasList', 'mapelList'));
    }

    public function inputNilai($id_kelas)
    {
        try {
            $kelas = Kelas::findOrFail($id_kelas);
            $santriList = Santri::where('id_kelas', $id_kelas)->get();
            $mapelList = MataPelajaran::all();

            // Ambil nilai yang sudah ada
            $mapel_id = request()->query('mapel_id');
            $nilaiData = collect();

            if ($mapel_id) {
                $nilaiData = Nilai::where('kelas_id', $id_kelas)
                    ->where('mapel_id', $mapel_id)
                    ->get();
            }

            return view('module.nilai.input', compact(
                'kelas',
                'santriList',
                'mapelList',
                'nilaiData',
                'mapel_id'
            ));

        } catch (\Exception $e) {
            return redirect()->route('nilai.index')
                           ->with('error', 'Kelas tidak ditemukan');
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'kelas_id' => 'required|exists:kelas,id_kelas',
                'mapel_id' => 'required|exists:mata_pelajaran,id_mata_pelajaran',
                'nilai' => 'required|array',
                'nilai.*.ulangan_1' => 'nullable|numeric|min:0|max:100',
                'nilai.*.ulangan_2' => 'nullable|numeric|min:0|max:100',
                'nilai.*.ulangan_3' => 'nullable|numeric|min:0|max:100',
            ]);

            foreach ($request->nilai as $santriId => $nilaiData) {
                Nilai::updateOrCreate(
                    [
                        'santri_id' => $santriId,
                        'kelas_id' => $request->kelas_id,
                        'mapel_id' => $request->mapel_id,
                    ],
                    [
                        'ulangan_1' => $nilaiData['ulangan_1'] ?? null,
                        'ulangan_2' => $nilaiData['ulangan_2'] ?? null,
                        'ulangan_3' => $nilaiData['ulangan_3'] ?? null,
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Nilai berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan nilai'
            ], 500);
        }
    }
}
