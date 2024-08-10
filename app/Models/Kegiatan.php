<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kegiatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kegiatan';

    protected $table = 'kegiatan';

    protected $fillable = [
        'id_kegiatan',
        'nama_kegiatan',
        'penanggung_jawab',
        'peserta',
        'id_tahun_ajaran',
    ];
}
