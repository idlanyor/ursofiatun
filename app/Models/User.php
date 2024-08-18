<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guarded = ['id'];
    protected $fillable = [
        'id',
        'nama',
        'username',
        'password',
        'role',
    ];
    protected $hidden = ['password'];
    public function guru()
    {
        return $this->hasOne(Guru::class, 'id');
    }
}