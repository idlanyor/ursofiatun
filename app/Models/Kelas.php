<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;
use App\Models\Santri;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    public $timestamps = false;
    protected $primaryKey =  'id_kelas';

    protected $fillable = [
        'nama_kelas',
        'id_tahun_ajaran',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function santri()
    {
        return $this->hasMany(Santri::class, 'id_kelas');
    }
}
