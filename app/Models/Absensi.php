<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    public $timestamps = false;
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_absensi_kelas',
        'id_santri',
        'tanggal',
        'status',
        'keterangan'
    ];

    public function absensiKelas()
    {
        return $this->belongsTo(AbsensiKelas::class, 'id_absensi_kelas', 'id_absensi_kelas');
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri', 'id_santri');
    }
}
