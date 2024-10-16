<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    public $timestamps = false;
    protected $primaryKey =  'id_absensi';

    protected $fillable = [
        'santri_id',
    ];

    public function absensiKelas()
    {
        return $this->belongsTo(AbsensiKelas::class, 'absensi_kelas_id');
    }
}
