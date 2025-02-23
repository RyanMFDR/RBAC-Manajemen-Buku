<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized - User not authenticated'], 401);
        }

        // Ambil role user
        $userRole = Auth::user()->role;

        // Periksa apakah role user sesuai dengan yang diizinkan
        if (!in_array($userRole, $roles)) {
            return response()->json(['message' => 'Forbidden - Access denied'], 403);
        }

        return $next($request);
    }
}
