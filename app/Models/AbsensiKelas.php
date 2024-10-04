<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKelas extends Model
{
    // use HasFactory;
    protected $primaryKey = 'id_absensi_kelas';
    protected $table = 'absensi_kelas';
    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'bulan'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_tahun_ajaran');
    }
}
