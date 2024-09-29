<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiBulan extends Model
{
    // use HasFactory;
    protected $primaryKey = 'id_absensi_bulan';
    protected $table = 'absensi_bulan';
    protected $fillable = [
        'id_tahun_ajaran',
        'id_kelas',
        'bulan'
    ];
}
