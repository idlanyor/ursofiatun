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
        $jumlahSantri = Santri::count();
        $jumlahGuru = Guru::count();
        $jumlahMataPelajaran = MataPelajaran::count();
        $kegiatan = Kegiatan::all();
        return view('dashboard', compact('jumlahSantri', 'jumlahGuru', 'jumlahMataPelajaran','kegiatan'));
    }

    public function getEvents()
    {
        $events = Kegiatan::all(); // Mengambil semua data events dari model Kegiatan

        return response()->json($events);
    }
}