<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class isResepsionis
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

        // cek di tabel role kamu ya. Di contohmu tadi resepsionis = 4 atau 2?
        // di modul biasanya: 4 = resepsionis
        if ((int) $roleAct === 4) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses ditolak (khusus Resepsionis).');
    }
}
