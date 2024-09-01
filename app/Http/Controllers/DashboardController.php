<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\MataPelajaran;
use App\Models\Santri;
use App\Models\TahunAjaran;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', 'aktif')->get();
        $id_tahun_ajaran = $tahunAjaran->first()->id_tahun_ajaran;
        // dd($id_tahun_ajaran);
        $kegiatan = Kegiatan::with('tahunAjaran')->get();
        return view('module.kegiatan.wrapper', compact('kegiatan', 'id_tahun_ajaran'));
        return view('dashboard', [
            'jumlahSantri' => Santri::count(),
            'jumlahGuru' => Guru::count(),
            'jumlahMataPelajaran' => MataPelajaran::count(),
            'kegiatan' => $kegiatan,
            'id_tahun_ajaran' => $id_tahun_ajaran
        ]);
    }

    public function getEvents()
    {
        $events = Kegiatan::with('tahunAjaran')->get(); // Mengambil semua data events dari model Kegiatan

        return response()->json($events);
    }
}
