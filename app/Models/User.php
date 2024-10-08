<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    public $timestamps = false;
    protected $primaryKey =  'id_user';
    protected $guarded = ['id_user'];
    protected $fillable = [
        'id_user',
        'nama',
        'username',
        'password',
        'role',
        'status',
    ];
    protected $hidden = ['password'];
}
