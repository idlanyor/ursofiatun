<?php

namespace App\Exports;

use App\Models\Guru;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GuruExport
{
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Tempat Lahir');
        $sheet->setCellValue('C1', 'Tanggal Lahir');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'Telepon');

        // Ambil data guru
        $dataGuru = Guru::all();

        $row = 2;
        foreach($dataGuru as $guru) {
            $sheet->setCellValue('A'.$row, $guru->nama);
            $sheet->setCellValue('B'.$row, $guru->tempat_lahir);
            $sheet->setCellValue('C'.$row, $guru->tanggal_lahir);
            $sheet->setCellValue('D'.$row, $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan');
            $sheet->setCellValue('E'.$row, $guru->alamat);
            $sheet->setCellValue('F'.$row, $guru->telepon);
            $row++;
        }

        // Atur lebar kolom otomatis
        foreach(range('A','F') as $column) {
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
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_guru_'.date('Y-m-d').'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
} 
