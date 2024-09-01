<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\LogActivities;
use App\Models\MataPelajaran;
use App\Models\Santri;
use App\Models\TahunAjaran;

class DashboardController extends Controller
{
    /**
     * Display a listing of the dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', 'aktif')->get();
        $id_tahun_ajaran = $tahunAjaran->first()->id_tahun_ajaran;
        $kegiatan = Kegiatan::with('tahunAjaran')->get();
        return view('dashboard', [
            'jumlahSantri' => Santri::count(),
            'jumlahGuru' => Guru::count(),
            'jumlahMataPelajaran' => MataPelajaran::count(),
            'kegiatan' => $kegiatan,
            'id_tahun_ajaran' => $id_tahun_ajaran
        ]);
    }

    /**
     * Mengambil semua data events dari model Kegiatan
     *
     * @return \Illuminate\Http\Response
     **/
    public function getEvents()
    {
        $events = Kegiatan::with('tahunAjaran')->get(); // Mengambil semua data events dari model Kegiatan

        return response()->json($events);
    }

    public function logs(){
        $logs = LogActivities::with('user')->get();
        return view('components.logs-activities',compact('logs'));
    }
}
