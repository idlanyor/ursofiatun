<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\AbsensiKelas;
use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $id_kelas;
    protected $bulan;
    protected $tahun;

    public function __construct($id_kelas, $bulan, $tahun)
    {
        $this->id_kelas = $id_kelas;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $santriList = Santri::where('id_kelas', $this->id_kelas)->get();
        $absensiKelas = AbsensiKelas::where('id_kelas', $this->id_kelas)
            ->where('bulan', strtolower(Carbon::createFromDate($this->tahun, $this->bulan, 1)->format('F')))
            ->first();

        if (!$absensiKelas) {
            return collect([]);
        }

        $jumlahHari = Carbon::createFromDate($this->tahun, $this->bulan, 1)->daysInMonth;
        $data = [];

        foreach ($santriList as $santri) {
            $row = [
                'nama' => $santri->nama,
            ];

            // Ambil data absensi
            $absensiData = Absensi::where('id_absensi_kelas', $absensiKelas->id_absensi_kelas)
                ->where('id_santri', $santri->id_santri)
                ->get()
                ->keyBy('tanggal');

            // Isi data kehadiran per hari
            for ($i = 1; $i <= $jumlahHari; $i++) {
                $row["tgl_$i"] = $absensiData->get($i)?->status ?? '-';
            }

            // Hitung total
            $row['hadir'] = $absensiData->where('status', 'H')->count();
            $row['sakit'] = $absensiData->where('status', 'S')->count();
            $row['izin'] = $absensiData->where('status', 'I')->count();
            $row['alpha'] = $absensiData->where('status', 'A')->count();

            $data[] = $row;
        }

        return collect($data);
    }

    public function headings(): array
    {
        $jumlahHari = Carbon::createFromDate($this->tahun, $this->bulan, 1)->daysInMonth;
        $headers = ['Nama Santri'];

        // Tambah header tanggal
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $headers[] = $i;
        }

        // Tambah header total
        $headers = array_merge($headers, ['Hadir', 'Sakit', 'Izin', 'Alpha']);

        return $headers;
    }

    public function map($row): array
    {
        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $sheet->getHighestColumn();

        // Style untuk header
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'E2EFDA',
                ],
            ],
        ]);

        // Style untuk seluruh cell
        $sheet->getStyle('A1:' . $lastColumn . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(15);

        // Set width untuk kolom tanggal
        $jumlahHari = Carbon::createFromDate($this->tahun, $this->bulan, 1)->daysInMonth;
        for ($i = 0; $i < $jumlahHari; $i++) {
            $sheet->getColumnDimensionByColumn($i + 3)->setWidth(5);
        }

        return $sheet;
    }
}
