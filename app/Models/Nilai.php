<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';
    public $timestamps = false;

    protected $fillable = [
        'ulangan_1',
        'ulangan_2',
        'ulangan_3',
        'santri_id',
        'kelas_id',
        'mapel_id'
    ];

    // Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id', 'id_santri');
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    // Relasi ke Mata Pelajaran
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id', 'id_mata_pelajaran');
    }
}
