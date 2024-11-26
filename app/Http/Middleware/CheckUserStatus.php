<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $excludedRoutes = [
            'logout',
            'login',
            'register',
            'profile.edit',
            'profile.update',
            'profile.destroy',
        ];

        if (in_array($request->route()->getName(), $excludedRoutes)) {
            return $next($request);
        }

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->status === 'pending') {
                if ($request->route()->getName() !== 'dashboard') {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
