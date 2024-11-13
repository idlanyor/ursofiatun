<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Models\AbsensiKelas;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use Carbon\Carbon;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelasList = Kelas::withCount('santri')->get();
        return view('module.absensi.index', compact('kelasList'));
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
        $absensiKelasId = $request->input('absensi_kelas_id');
        $absensiData = $request->input('absensi');

        foreach ($absensiData as $santriId => $tanggalData) {
            foreach ($tanggalData as $tanggal => $status) {
                Absensi::updateOrCreate(
                    [
                        'absensi_kelas_id' => $absensiKelasId,
                        'santri_id' => $santriId,
                        'tanggal' => $tanggal,
                    ],
                    ['status' => strtoupper($status)]
                );
            }
        }

        return response()->json(['message' => 'Data absensi berhasil disimpan']);
    }


    /**
     * Display the specified resource.
     */
    public function show($kelasId)
    {
        $bulan = request()->query('bulan', date('F')); // Mengambil bulan dari query atau bulan saat ini

        // Mengambil data absensi kelas
        $absensiKelasBulan = AbsensiKelas::where('kelas_id', $kelasId)
            ->where('bulan', strtolower($bulan))
            ->firstOrFail();

        // Mengambil daftar santri
        $santriList = Santri::where('kelas_id', $kelasId)->get();

        // Mengambil daftar tanggal untuk bulan yang dipilih
        $tahun = date('Y');
        $bulanAngka = date('m', strtotime($bulan));
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulanAngka, $tahun);
        $tanggalAbsensi = [];

        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggalAbsensi[] = $i;
        }

        // Mengambil data absensi
        $absensiData = Absensi::where('absensi_kelas_id', $absensiKelasBulan->id)->get();

        // Daftar bulan untuk dropdown
        $bulanList = [
            'januari',
            'februari',
            'maret',
            'april',
            'mei',
            'juni',
            'juli',
            'agustus',
            'september',
            'oktober',
            'november',
            'desember'
        ];

        return view('module.absensi.absensi-santri', compact(
            'absensiKelasBulan',
            'santriList',
            'tanggalAbsensi',
            'absensiData',
            'bulanList'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idAbsen)
    {
        $absensiKelas = AbsensiKelas::with('kelas')->where('id_kelas', $idAbsen)->get();
        // $santri = Santri::with('kelas')->where('id_kelas', $idAbsen)->get();
        // $absensiSantri = Absensi::with(['absensiKelas', 'santri'])->where('santri_id', $idAbsen)->get();
        // dd($absensiSantri)
        return response()->json(compact('absensiKelas', 'idAbsen'));
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

    public function generatePDF($id_kelas, $bulan)
    {
        $santriList = Santri::where('id_kelas', $id_kelas)->get();
        $kelas = Kelas::find($id_kelas);
        $tahunAjaran = $kelas->tahunAjaran()->where('status', 'aktif')->first();
        $tahun_ajaran = $tahunAjaran ? $tahunAjaran->tahun_ajaran : 'Tidak Diketahui';

        $data = [];
        foreach ($santriList as $santri) {
            $absensiData = Absensi::where('id_santri', $santri->id_santri)
                ->whereHas('absensiKelas', function ($query) use ($bulan) {
                    $query->where('bulan', $bulan);
                })
                ->get()
                ->pluck('status')
                ->toArray();

            $data[] = [
                'nama' => $santri->nama,
                'absensi' => $absensiData,
            ];
        }

        // Load view ke dalam PDF
        $pdf = PDF::loadView('pdf.absensi', compact('data', 'bulan', 'tahun_ajaran', 'kelas->nama_kelas'))
            ->setPaper([0, 0, 595.276, 935.433], 'landscape')
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->setOption('margin-top', 5)
            ->setOption('margin-bottom', 5)
            ->setOption('margin-left', 5)
            ->setOption('margin-right', 5);
        // Download PDF dengan nama file tertentu
        return $pdf->download("Absensi_Santri_TPQ_Al_Falah_$bulan.pdf");
    }

    public function showHarian($id_kelas)
    {
        try {
            $kelas = Kelas::findOrFail($id_kelas);
            $tanggal = request()->query('tanggal', date('Y-m-d'));

            // Ambil data santri
            $santriList = Santri::where('id_kelas', $id_kelas)->get();

            // Cari atau buat absensi kelas untuk bulan ini
            $bulan = strtolower(date('F', strtotime($tanggal)));
            $absensiKelas = AbsensiKelas::firstOrCreate(
                [
                    'id_kelas' => $id_kelas,
                    'bulan' => $bulan
                ]
            );

            // Ambil data absensi untuk tanggal yang dipilih
            $absensiData = Absensi::where('id_absensi_kelas', $absensiKelas->id_absensi_kelas)
                ->where('tanggal', date('j', strtotime($tanggal)))
                ->get();

            return view('module.absensi.absensi-harian', compact(
                'kelas',
                'tanggal',
                'santriList',
                'absensiData',
                'absensiKelas'
            ));
        } catch (\Exception $e) {
            return redirect()->route('absensi.index')
                ->with('error', 'Kelas tidak ditemukan');
        }
    }

    public function storeHarian(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'id_kelas' => 'required|exists:kelas,id_kelas',
                'tanggal' => 'required|date',
                'id_absensi_kelas' => 'required|exists:absensi_kelas,id_absensi_kelas',
                'status' => 'required|array',
                'status.*' => 'required|in:H,S,I,A',
                'keterangan' => 'array'
            ]);

            $tanggalHari = date('j', strtotime($request->tanggal));

            foreach ($request->status as $santriId => $status) {
                Absensi::updateOrCreate(
                    [
                        'id_absensi_kelas' => $request->id_absensi_kelas,
                        'id_santri' => $santriId,
                        'tanggal' => $tanggalHari,
                    ],
                    [
                        'status' => $status,
                        'keterangan' => $request->keterangan[$santriId] ?? null
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data absensi berhasil disimpan'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data'
            ], 500);
        }
    }

    public function exportExcel($idKelas, $bulan, $tahun)
    {
        return Excel::download(new AbsensiExport($idKelas, $bulan, $tahun), 'absensi.xlsx');
    }

    // Mendapatkan rekap absensi per kelas per bulan
    public function getRekapKelas($idKelas, $bulan)
    {
        $absensiKelas = AbsensiKelas::where('id_kelas', $idKelas)
            ->where('bulan', $bulan)
            ->first();

        if (!$absensiKelas) {
            return collect();
        }

        return Absensi::where('id_absensi_kelas', $absensiKelas->id_absensi_kelas)
            ->select(
                'id_santri',
                DB::raw('COUNT(CASE WHEN status = "H" THEN 1 END) as hadir'),
                DB::raw('COUNT(CASE WHEN status = "S" THEN 1 END) as sakit'),
                DB::raw('COUNT(CASE WHEN status = "I" THEN 1 END) as izin'),
                DB::raw('COUNT(CASE WHEN status = "A" THEN 1 END) as alpha')
            )
            ->groupBy('id_santri')
            ->get();
    }

    // Mendapatkan detail absensi santri per bulan
    public function getDetailSantri($idSantri, $bulan)
    {
        return Absensi::whereHas('absensiKelas', function ($query) use ($bulan) {
            $query->where('bulan', $bulan);
        })
            ->where('id_santri', $idSantri)
            ->orderBy('tanggal')
            ->get();
    }

    public function export($id_kelas, Request $request)
    {
        $bulan = $request->query('bulan', date('m'));
        $tahun = $request->query('tahun', date('Y'));
        $format = $request->query('format', 'xlsx');

        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->format('F');
        $namaKelas = Kelas::find($id_kelas)->nama_kelas;
        $fileName = "Absensi Kelas {$namaKelas} - {$namaBulan} {$tahun}";

        if ($format === 'pdf') {
            $export = new AbsensiExport($id_kelas, $bulan, $tahun);
            $data = [
                'absensi' => $export->collection(),
                'kelas' => $namaKelas,
                'bulan' => $namaBulan,
                'tahun' => $tahun
            ];

            $pdf = PDF::loadView('module.absensi.pdf', $data);
            return $pdf->download($fileName . '.pdf');
        }

        return Excel::download(
            new AbsensiExport($id_kelas, $bulan, $tahun),
            $fileName . '.xlsx'
        );
    }
}
