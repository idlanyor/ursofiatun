<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TemplateController extends Controller
{
    public function downloadTemplateSantri()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'nama');
        $sheet->setCellValue('B1', 'tempat_lahir');
        $sheet->setCellValue('C1', 'tanggal_lahir');
        $sheet->setCellValue('D1', 'jenis_kelamin');
        $sheet->setCellValue('E1', 'orang_tua');
        $sheet->setCellValue('F1', 'telepon');
        $sheet->setCellValue('G1', 'alamat');
        $sheet->setCellValue('H1', 'id_kelas');

        // Tambahkan contoh data
        $sheet->setCellValue('A2', 'Ahmad');
        $sheet->setCellValue('B2', 'Jakarta');
        $sheet->setCellValue('C2', '2000-01-01');
        $sheet->setCellValue('D2', 'L');
        $sheet->setCellValue('E2', 'Budi');
        $sheet->setCellValue('F2', '08123456789');
        $sheet->setCellValue('G2', 'Jl. Contoh No. 123');
        $sheet->setCellValue('H2', '1');

        // Tambahkan keterangan di baris ketiga
        $sheet->setCellValue('A3', '(Isi dengan nama lengkap)');
        $sheet->setCellValue('B3', '(Isi dengan tempat lahir)');
        $sheet->setCellValue('C3', '(Format: YYYY-MM-DD)');
        $sheet->setCellValue('D3', '(Isi dengan L/P)');
        $sheet->setCellValue('E3', '(Isi dengan nama orang tua)');
        $sheet->setCellValue('F3', '(Isi dengan nomor telepon)');
        $sheet->setCellValue('G3', '(Isi dengan alamat lengkap)');
        $sheet->setCellValue('H3', '(Isi dengan ID kelas yang valid)');

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

        // Buat file Excel
        $writer = new Xlsx($spreadsheet);

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="template_import_santri.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
} 
