<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    public $timestamps = false;
    protected $primaryKey =  'id_tahun_ajaran';


    protected $fillable = [
        'tahun_mulai',
        'tahun_akhir',
        'status',
    ];
}
