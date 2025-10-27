<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class isResepsionis
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) return redirect()->route('login');

        $roleAct = DB::table('user_role')
            ->where('iduser', Auth::id())
            ->where('status', 1)
            ->value('idrole');

        if ((int) $roleAct === 2) return $next($request);

        return redirect()->route('home')->with('error', 'Akses ditolak (khusus Resepsionis).');
    }
}
