<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LogActivities;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public function handle($request, Closure $next)
    {
        LogActivities::create([
            'user_id' => Auth::user()->id_user ?? 1,
            'ip_address' => $request->ip(),
            'route' => $request->path(),
            'action' => 'Akses ' . $request->method(),
        ]);

        return $next($request);
    }
}
