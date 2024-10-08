<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';

    public $timestamps = false;
    protected $primaryKey =  'id_santri';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'telepon',
        'orang_tua',
        'id_kelas',
    ];

    // Perbaikan relasi dengan kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // Tidak ada perubahan pada metode untuk eager loading
    public static function withKelas()
    {
        return self::with('kelas');
    }
}
