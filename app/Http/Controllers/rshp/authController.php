<?php

namespace App\Http\Controllers\Rshp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('rshp.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            // jangan seret halaman terakhir
            $request->session()->forget('url.intended');
            // SELALU ke dashboard admin (sesuai routes/web.php di atas)
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'login' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // balik ke halaman login sesuai penamaan route-mu
        return redirect()->route('login');
    }
}
