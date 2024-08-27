<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\MataPelajaran;
use App\Models\Santri;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'jumlahSantri' => Santri::count(),
            'jumlahGuru' => Guru::count(),
            'jumlahMataPelajaran' => MataPelajaran::count(),
            'kegiatan' => Kegiatan::with('tahunAjaran')->get()
        ]);
    }

    public function getEvents()
    {
        $events = Kegiatan::all(); // Mengambil semua data events dari model Kegiatan

        return response()->json($events);
    }
}
