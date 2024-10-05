<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;

class Kegiatan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey =  'id_kegiatan';

    protected $table = 'kegiatan';

    protected $fillable = [
        'id_kegiatan',
        'nama_kegiatan',
        'penanggung_jawab',
        'periode',
        'tanggal_pelaksanaan',
        'id_tahun_ajaran',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }
}
