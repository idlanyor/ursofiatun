<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    public $timestamps = false;
    protected $primaryKey =  'id_user';
    protected $guarded = ['id_user'];
    protected $fillable = [
        'nama',
        'email',
        'soc_website',
        'soc_github',
        'soc_x',
        'soc_ig',
        'soc_fb',
        'alamat',
        'notelp',
        'username',
        'password',
        'role',
        'status'
    ];
    protected $hidden = ['password'];
}
