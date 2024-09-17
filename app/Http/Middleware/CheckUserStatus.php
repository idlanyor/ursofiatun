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
        // Daftar rute sing ora perlu dipriksa status
        $excludedRoutes = [
            'logout',
            'login',
            'register',
            // Tambahake rute liyane yen perlu
        ];

        // Mbandingake rute saiki karo rute sing dikecualikan
        if (in_array($request->route()->getName(), $excludedRoutes)) {
            return $next($request);
        }

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->status === 'pending') {
                // Redirect menyang dashboard lan tambahi pesan warning
                if ($request->route()->getName() !== 'dashboard') {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
