<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKelas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey =  'id_absensi_kelas';
    protected $table = 'absensi_kelas';
    protected $fillable = [
        'id_kelas',
        'bulan'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_absensi_kelas', 'id_absensi_kelas');
    }
}
