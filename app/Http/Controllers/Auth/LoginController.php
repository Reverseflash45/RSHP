<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1) Validasi input
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string', // bisa email atau username
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // 2) Tentukan identifier: email atau nama
        $identifier = $request->input('email');
        $byEmail    = filter_var($identifier, FILTER_VALIDATE_EMAIL) !== false;

        // 3) Cari user via Eloquent (lebih aman dari DB::table langsung)
        //    Pastikan tabel & kolom ada supaya tidak meledak di first()
        if (!Schema::hasTable('user')) {
            return back()->withErrors(['email' => 'Tabel "user" tidak ditemukan. Periksa koneksi/skema DB.']);
        }
        $query = User::query();
        if ($byEmail && Schema::hasColumn('user', 'email')) {
            $query->where('email', $identifier);
        } else {
            // fallback: coba kolom 'nama' jika login tidak pakai email
            if (!Schema::hasColumn('user', 'nama')) {
                return back()->withErrors(['email' => 'Kolom login tidak valid (email/nama tidak ada di tabel user).']);
            }
            $query->where('nama', $identifier);
        }

        /** @var User|null $user */
        $user = $query->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.'])->withInput();
        }

        // 4) Verifikasi password hash
        if (!Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        // 5) Ambil role aktif via pivot jika tabelnya ada
        $roleId = 0;
        $roleName = 'User';
        $roleStat = 0;

        if (Schema::hasTable('user_role') && Schema::hasTable('role')) {
            $pivot = DB::table('user_role')
                ->where('iduser', $user->iduser)
                ->where('status', 1)
                ->first();

            $roleId   = (int) ($pivot->idrole ?? 0);
            $roleName = DB::table('role')->where('idrole', $roleId)->value('nama_role') ?? 'User';
            $roleStat = (int) ($pivot->status ?? 0);
        }

        // 6) Login guard
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // 7) Simpan session seperti modul
        $request->session()->put([
            'user_id'         => (int) $user->iduser,
            'user_name'       => (string) $user->nama,
            'user_email'      => (string) $user->email,
            'user_role'       => $roleId,
            'user_role_name'  => $roleName,
            'user_status'     => $roleStat,
        ]);

        // 8) Redirect sesuai role (1=Admin, 2=Dokter, 3=Perawat, 4=Resepsionis, lainnya=Pemilik)
        switch ($roleId) {
            case 1: return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case 2: return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case 3: return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case 4: return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            default: return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
