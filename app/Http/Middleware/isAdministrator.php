<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class isAdministrator
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId  = Auth::id();
        $roleAct = DB::table('user_role')
            ->where('iduser', $userId)
            ->where('status', 1)
            ->value('idrole');

        if ((int) $roleAct === 1) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses ditolak (khusus Administrator).');
    }
}
