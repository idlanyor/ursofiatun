<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Exports\GuruExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::paginate(10);
        return view('module.guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.guru.create');
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
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Guru::create($validator->validated());

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return response()->json($guru);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return response()->json($guru);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:15',
        ]);

        try {
            $guru->update([
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            return response()->json(['success' => 'Data guru berhasil diupdate.']);
        } catch (\Exception $e) {
            Log::error('Error updating guru: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            $guru->delete();
            return response()->json(['success' => 'Data guru berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting guru: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data guru.'], 500);
        }
    }

    public function export()
    {
        try {
            $export = new GuruExport();
            return $export->export();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat export data: ' . $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Skip header row
            array_shift($rows);

            foreach ($rows as $row) {
                if (!empty($row[0])) {
                    Guru::create([
                        'nama' => $row[0],
                        'tempat_lahir' => $row[1],
                        'tanggal_lahir' => $row[2],
                        'jenis_kelamin' => $row[3],
                        'alamat' => $row[4],
                        'telepon' => $row[5],
                    ]);
                }
            }

            return response()->json(['success' => 'Data guru berhasil diimport.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat import data: ' . $e->getMessage()], 500);
        }
    }

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'nama');
        $sheet->setCellValue('B1', 'tempat_lahir');
        $sheet->setCellValue('C1', 'tanggal_lahir');
        $sheet->setCellValue('D1', 'jenis_kelamin');
        $sheet->setCellValue('E1', 'alamat');
        $sheet->setCellValue('F1', 'telepon');

        // Contoh data
        $sheet->setCellValue('A2', 'Ahmad');
        $sheet->setCellValue('B2', 'Jakarta');
        $sheet->setCellValue('C2', '2000-01-01');
        $sheet->setCellValue('D2', 'L');
        $sheet->setCellValue('E2', 'Jl. Contoh No. 123');
        $sheet->setCellValue('F2', '08123456789');

        // Atur lebar kolom
        foreach(range('A','F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Header style
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4e73df'],
            ],
        ];
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="template_import_guru.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
