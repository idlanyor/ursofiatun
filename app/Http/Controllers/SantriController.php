<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Imports\SantriImport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan eager loading untuk menghindari N+1 problem
        $dataSantri = Santri::with('kelas')->paginate(10);
        $kelas = Kelas::all();
        // dd($dataSantri);
        return view('module.santri.index', compact('dataSantri', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menggunakan eager loading untuk menghindari N+1 problem
        $dataKelas = Kelas::with('tahunAjaran')->get();
        return view('module.santri.create', compact('dataKelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'orang_tua' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Santri::create($validator->validated());

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $santri = Santri::findOrFail($id);
        return response()->json($santri);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        return response()->json($santri);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'orang_tua' => 'nullable|string',
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:15',
            'kelas' => 'required|exists:kelas,id_kelas'
        ]);

        try {
            $santri->update([
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => Carbon::parse($request->tanggal_lahir)->format('Y-m-d'),
                'jenis_kelamin' => $request->jenis_kelamin,
                'orang_tua' => $request->orang_tua,
                'alamat' => $request->alamat,
                'id_kelas' => $request->kelas,
                'telepon' => $request->telepon,
            ]);

            return response()->json(['success' => 'Data santri berhasil diupdate.']);
        } catch (\Exception $e) {
            Log::error('Error updating santri: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $santri = Santri::findOrFail($id);
            $santri->delete();
            return response()->json(['success' => 'Data santri berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting santri: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data santri.'], 500);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            DB::beginTransaction();

            $import = new SantriImport;
            Excel::import($import, $request->file('file'));

            if (!empty($import->getErrors())) {
                DB::rollBack();
                return response()->json([
                    'error' => 'Terjadi kesalahan validasi data:',
                    'details' => $import->getErrors()
                ], 422);
            }

            DB::commit();
            return response()->json(['success' => 'Data santri berhasil diimport.']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Terjadi kesalahan saat import data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function exportSantri()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Tempat Lahir');
        $sheet->setCellValue('C1', 'Tanggal Lahir');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Kelas');
        $sheet->setCellValue('F1', 'Orang Tua');
        $sheet->setCellValue('G1', 'Telepon');
        $sheet->setCellValue('H1', 'Alamat');

        // Ambil data santri
        $dataSantri = Santri::with('kelas')->get();

        $row = 2;
        foreach($dataSantri as $santri) {
            $sheet->setCellValue('A'.$row, $santri->nama);
            $sheet->setCellValue('B'.$row, $santri->tempat_lahir);
            $sheet->setCellValue('C'.$row, $santri->tanggal_lahir);
            $sheet->setCellValue('D'.$row, $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan');
            $sheet->setCellValue('E'.$row, $santri->kelas->nama_kelas);
            $sheet->setCellValue('F'.$row, $santri->orang_tua);
            $sheet->setCellValue('G'.$row, $santri->telepon);
            $sheet->setCellValue('H'.$row, $santri->alamat);
            $row++;
        }

        // Atur lebar kolom otomatis
        foreach(range('A','H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Atur style header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4e73df'],
            ],
        ];
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_santri_'.date('Y-m-d').'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
