<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (
            !$user ||
            !(
                $user->hasAnyRole(['super_admin', 'admin_diklat']) ||
                in_array($user->role_label, ['super_admin', 'admin_diklat'])
            )
        ) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}