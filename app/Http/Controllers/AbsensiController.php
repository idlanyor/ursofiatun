<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Models\AbsensiKelas;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Santri;

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
    public function store(StoreAbsensiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $absensiKelas = AbsensiKelas::with('kelas')->where('id_kelas', $id)->get();
        $absensiSantri = Santri::with('kelas')->where('id_kelas', $id)->get();
        // dd($absensiSantri)
        // dd($absensiKelas);
        return view('module.absensi.absensi-santri', compact('absensiKelas', 'absensiSantri'));
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
