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

        // Ambil role aktif dari pivot. Ubah angka 5 jika mappingmu beda.
        $roleId = (int) DB::table('user_role')
            ->where('iduser', Auth::id())
            ->where('status', 1)
            ->value('idrole');

        if ($roleId === 5) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses ditolak (khusus Pemilik).');
    }
}
