<?php

namespace App\Imports;

use App\Models\Santri;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class SantriImport implements
    ToCollection,
    WithHeadingRow,
    WithValidation,
    SkipsEmptyRows,
    SkipsOnFailure
{
    protected $errors = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Skip jika semua kolom kosong
            if ($this->isEmptyRow($row)) {
                continue;
            }

            // Validasi id_kelas
            if (!$this->isValidKelas($row['id_kelas'])) {
                $this->errors[] = "ID Kelas '{$row['id_kelas']}' tidak valid";
                continue;
            }

            Santri::create([
                'nama' => $row['nama'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'id_kelas' => $row['id_kelas'],
                'orang_tua' => $row['orang_tua'] ?? null,
                'telepon' => $row['telepon'] ?? null,
                'alamat' => $row['alamat'] ?? null,
            ]);
        }
    }

    private function isEmptyRow($row): bool
    {
        return empty(array_filter($row->toArray(), function ($value) {
            return $value !== null && $value !== '' && $value !== 0;
        }));
    }

    private function isValidKelas($id_kelas)
    {
        return \App\Models\Kelas::where('id_kelas', $id_kelas)->exists();
    }

    public function rules(): array
    {
        return [
            '*.nama' => 'required|string',
            '*.tempat_lahir' => 'required|string',
            '*.tanggal_lahir' => 'required|date',
            '*.jenis_kelamin' => 'required|in:L,P',
            '*.id_kelas' => 'required|exists:kelas,id_kelas',
            '*.orang_tua' => 'nullable',
            '*.telepon' => 'nullable',
            '*.alamat' => 'nullable',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // foreach ($failures as $failure) {
        //     $this->errors[] = $failure->errors()[0];
        // }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
