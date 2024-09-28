<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    protected $primaryKey = 'id_sarpras';
    protected $table = 'sarpras';
    protected $fillable = ['nama_barang', 'tanggal_pengadaan', 'kondisi', 'jumlah'];
    use HasFactory;
}
