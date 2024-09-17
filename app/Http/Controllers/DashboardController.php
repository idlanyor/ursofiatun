<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\LogActivities;
use App\Models\Santri;
use App\Models\TahunAjaran;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', 'aktif')->get();
        $id_tahun_ajaran = null;

        if ($tahunAjaran->isNotEmpty()) {
            $id_tahun_ajaran = $tahunAjaran->first()->id_tahun_ajaran;
        }

        $kegiatan = Kegiatan::with('tahunAjaran')->get();

        return view('dashboard', [
            'jumlahSantri' => Santri::count(),
            'jumlahGuru' => Guru::count(),
            'jumlahKelas' => Kelas::count(),
            'userPending' => User::where('status', 'pending')->count(),
            'kegiatan' => $kegiatan,
            'id_tahun_ajaran' => $id_tahun_ajaran,
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

    public function logs()
    {
        $logs = LogActivities::with('user')->get();
        return view('components.logs-activities', compact('logs'));
    }
}
