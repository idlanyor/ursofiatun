<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\AbsensiKelas;
// use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport
{
    protected $idKelas;
    protected $bulan;

    public function __construct($idKelas, $bulan)
    {
        $this->idKelas = $idKelas;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        $absensiKelas = AbsensiKelas::where('id_kelas', $this->idKelas)
            ->where('bulan', $this->bulan)
            ->first();

        return Absensi::with('santri')
            ->where('id_absensi_kelas', $absensiKelas->id_absensi_kelas)
            ->get()
            ->map(function($absensi) {
                return [
                    'Tanggal' => $absensi->tanggal,
                    'Nama Santri' => $absensi->santri->nama,
                    'Status' => $absensi->status,
                    'Keterangan' => $absensi->keterangan
                ];
            });
    }
}
