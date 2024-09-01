<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivities extends Model
{
    use HasFactory;
    protected $table = 'log_activities';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'ip_address',
        'route',
        'action',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
