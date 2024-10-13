<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Models\AbsensiKelas;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('tahunAjaran')->whereRelation('tahunAjaran', 'status', 'aktif')->paginate(10);
        $jumlahSantriPerKelas = Santri::with('kelas')->get()->groupBy('id_kelas')->mapWithKeys(function ($group) {
            return [$group->first()->id_kelas => $group->count()];
        });
        $jumlahMapelPerKelas = MataPelajaran::with('kelas')->get()->groupBy('kelas_id')->mapWithKeys(function ($group) {
            return [$group->first()->kelas_id => $group->count()];
        });
        return view('module.absensi.absensi-kelas', compact('kelas', 'jumlahSantriPerKelas', 'jumlahMapelPerKelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $absensiData = [];
        // dd($request->input('absensi_kelas_id'));
        foreach ($request->input('absensi') as $santriId => $absensi) {
            $data = [
                'santri_id' => $santriId,
                'absensi_kelas' => $request->input('absensi_kelas_id'),
            ];

            for ($i = 1; $i <= 31; $i++) {
                $data[$i] = $absensi[$i] ?? 'H'; // Misal default 'H' untuk yang tidak diisi
            }

            $absensiData[] = $data;
        }

        DB::table('absensi')->insert($absensiData);

        return redirect()->back()->with('success', 'Data absensi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($idAbsen)
    {
        $absensiKelas = AbsensiKelas::with('kelas')->where('id_kelas', $idAbsen)->get();
        $absensiSantri = Santri::with('kelas')->where('id_kelas', $idAbsen)->get();
        // dd($absensiSantri)
        // dd($absensiKelas);
        return view('module.absensi.absensi-santri', compact('absensiKelas', 'absensiSantri', 'idAbsen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
