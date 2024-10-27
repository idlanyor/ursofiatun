<?php

namespace App\Http\Controllers;

use App\Events\AbsensiEvent;
use App\Models\Absensi;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Models\AbsensiKelas;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


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
        // $absensiData = [];
        // dd($request->input('absensi_kelas_id'));

        foreach ($request->input('absensi') as $santriId => $absensi) {
            // Data untuk setiap santri
            $data = [
                'santri_id' => strval($santriId),
                'absensi_kelas' => strval($request->input('absensi_kelas_id')),
            ];

            for ($i = 1; $i <= 31; $i++) {
                $data[$i] = $absensi[$i] ?? 'H'; // Misal default 'H' untuk yang tidak diisi
            }

            // Gunakan `updateOrCreate` untuk mencegah duplikat
            Absensi::updateOrCreate(
                [
                    'santri_id' => $santriId, // Syarat pencarian berdasarkan `santri_id`
                    'absensi_kelas' => $request->input('absensi_kelas_id') // dan `absensi_kelas`
                ],
                $data // Data yang akan diisi jika tidak ditemukan, atau diupdate jika ditemukan
            );
            event(new AbsensiEvent(
                data: $data
            ));
        }



        return redirect()->back()->with('success', 'Data absensi berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show($idAbsen)
    {
        // dd(Absensi::all());

        $absensiKelas = AbsensiKelas::with('kelas')->where('id_kelas', $idAbsen)->get();
        $santri = Santri::with('kelas')->where('id_kelas', $idAbsen)->get();
        $absensiSantri = Absensi::with(['absensiKelas', 'santri'])->where('santri_id', $idAbsen)->get();
        // dd($absensiSantri)
        return response()->json(compact('absensiKelas', 'absensiSantri', 'santri', 'idAbsen'));
        // return view('module.absensi.absensi-santri', compact('absensiKelas', 'absensiSantri','santri', 'idAbsen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        return view('module.absensi.absensi-santri');
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

    public function generatePDF()
    {
        $santri = [
            ['nama' => 'Lorem', 'absensi' => ['H', 'H', 'H', 'I', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Ipsum', 'absensi' => ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Dolor', 'absensi' => ['H', 'H', 'H', 'S', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Sit', 'absensi' => ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Amet', 'absensi' => ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Constecterur', 'absensi' => ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Adiplicising', 'absensi' => ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Elit', 'absensi' => ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Rum', 'absensi' => ['H', 'H', 'H', 'A', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            ['nama' => 'Et', 'absensi' => ['H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H', 'H']],
            // Tambah data santri lainnya...
        ];
        dd($santri);

        $bulan = 'Oktober';
        $tahun_ajaran = '2023/2024';
        $kelas = 'XII TKR';

        // Load view ke dalam PDF
        $pdf = PDF::loadView('pdf.absensi', compact('santri', 'bulan', 'tahun_ajaran', 'kelas'))
            ->setPaper([0, 0, 595.276, 935.433], 'landscape')
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->setOption('margin-top', 5)
            ->setOption('margin-bottom', 5)
            ->setOption('margin-left', 5)
            ->setOption('margin-right', 5);
        // Download PDF dengan nama file tertentu
        return $pdf->download("Absensi_Santri_TPQ_Al_Falah_$bulan.pdf");
    }
}
