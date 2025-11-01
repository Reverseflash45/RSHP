<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class isPerawat
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $roleAct = DB::table('role_user')
            ->where('iduser', Auth::id())
            ->where('status', 1)
            ->value('idrole');

        // di modul biasanya perawat = 3
        if ((int) $roleAct === 3) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses ditolak (khusus Perawat).');
    }
}
