<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // ini gak terlalu kepake krn kita redirect per-role
    protected $redirectTo = '/home';

    public function __construct()
    {
        // yang belum login boleh akses login
        $this->middleware('guest')->except('logout');
        // cuma yang udah login yang boleh logout
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        // pake view login yang tadi kamu kirim
        return view('auth.login');
    }

    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Validasi input
        |--------------------------------------------------------------------------
        */
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string',   // boleh email, boleh nama
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Pastikan tabel 'user' memang ada
        |--------------------------------------------------------------------------
        */
        if (! Schema::hasTable('user')) {
            return back()->withErrors([
                'login' => 'Tabel "user" tidak ditemukan di database. Periksa nama tabel.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Cari user di tabel 'user' pakai MODEL (bukan DB::table)
        |--------------------------------------------------------------------------
        | kalau input berupa email, kita cari by email
        | kalau bukan email, kita anggap itu nama
        */
        $identifier = $request->input('email');
        $isEmail    = filter_var($identifier, FILTER_VALIDATE_EMAIL);

        // mulai query dari model
        $userQuery = User::query();

        if ($isEmail && Schema::hasColumn('user', 'email')) {
            $userQuery->where('email', $identifier);
        } else {
            // login pakai nama
            if (! Schema::hasColumn('user', 'nama')) {
                return back()->withErrors([
                    'login' => 'Kolom "nama" tidak ada di tabel user, tidak bisa login pakai nama.'
                ])->withInput();
            }

            $userQuery->where('nama', $identifier);
        }

        /** @var \App\Models\User|null $user */
        $user = $userQuery->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Akun tidak ditemukan.'
            ])->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Cek password
        |--------------------------------------------------------------------------
        */
        if (! Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.'
            ])->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Ambil role aktif dari pivot `role_user`
        |--------------------------------------------------------------------------
        | tabelmu: role_user (bukan user_role)
        | kolom: iduser, idrole, status
        */
        $roleId   = 0;
        $roleName = 'User';
        $roleStat = 0;

        if (Schema::hasTable('role_user')) {
            $pivot = DB::table('role_user')
                ->where('iduser', $user->iduser)
                ->where('status', 1)
                ->first();

            if ($pivot) {
                $roleId   = (int) $pivot->idrole;
                $roleStat = (int) $pivot->status;

                // ambil nama rolenya
                if (Schema::hasTable('role')) {
                    $roleName = DB::table('role')
                        ->where('idrole', $roleId)
                        ->value('nama_role') ?? 'User';
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Login ke guard
        |--------------------------------------------------------------------------
        | Ini baris yang tadi meledak.
        | Pastikan yang dikirim benar2 instance App\Models\User
        */
        Auth::guard('web')->login($user, $request->filled('remember'));

        // regenerasi session id biar aman
        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | 7. Simpan session biar Blade bisa akses persis kaya modul
        |--------------------------------------------------------------------------
        */
        $request->session()->put([
            'user_id'        => (int) $user->iduser,
            'user_name'      => (string) $user->nama,
            'user_email'     => (string) $user->email,
            'user_role'      => $roleId,
            'user_role_name' => $roleName,
            'user_status'    => $roleStat,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 8. Redirect sesuai role
        |--------------------------------------------------------------------------
        | mapping dari SQL dump kamu:
        | 1 = admin
        | 2 = dokter           (kalau beda, ganti di sini)
        | 3 = perawat
        | 4 = resepsionis
        | 5 = pemilik
        */
        switch ($roleId) {
            case 1:
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case 2:
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case 3:
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case 4:
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            case 5:
            default:
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('site.home')->with('success', 'Logout berhasil.');
    }
}
