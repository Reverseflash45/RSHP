<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        // Logout user (menghapus autentikasi)
        Auth::logout();
        
        // Hapus semua session data
        Session::flush();
        
        // Regenerate session token untuk keamanan
        $request->session()->regenerateToken();
        
        // Redirect ke home
        return redirect()->route('home');
    }
}