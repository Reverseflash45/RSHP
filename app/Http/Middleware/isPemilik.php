<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class isPemilik
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

        // di dump-mu tadi kelihatannya pemilik itu 5
        if ((int) $roleAct === 5) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses ditolak (khusus Pemilik).');
    }
}
