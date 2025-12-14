<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepsionisController extends Controller
{
    public function dashboard()
    {
        return view('rshp.Resepsionis.dashboard');
    }

    public function temuDokter()
    {
        $allPets = DB::table('pet')
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->select(
                'pet.idpet',
                'pet.nama as nama_pet',
                'user.nama as nama_pemilik'
            )
            ->orderBy('pet.nama')
            ->get();

        $activePetIds = DB::table('temu_dokter')
            ->whereDate('waktu_daftar', today())
            ->pluck('idpet')
            ->toArray();

        $dokter = DB::table('role_user as ru')
            ->join('role as r', 'r.idrole', '=', 'ru.idrole')
            ->join('user as u', 'u.iduser', '=', 'ru.iduser')
            ->select('ru.idrole_user', 'u.nama as nama_dokter')
            ->where('r.nama_role', 'Dokter')
            ->where('ru.status', 1)
            ->orderBy('u.nama')
            ->get();

        $antrian = DB::table('temu_dokter as td')
            ->join('pet as p', 'p.idpet', '=', 'td.idpet')
            ->join('role_user as ru', 'ru.idrole_user', '=', 'td.idrole_user')
            ->join('user as ud', 'ud.iduser', '=', 'ru.iduser')
            ->select(
                'td.idtemu_dokter',
                'td.no_urut',
                'td.waktu_daftar',
                'p.nama as nama_pet',
                'ud.nama as nama_dokter',
                'td.status'
            )
            ->whereDate('td.waktu_daftar', today())
            ->orderBy('td.no_urut')
            ->get();

        return view('rshp.Resepsionis.edit_temudokter', compact('allPets', 'activePetIds', 'dokter', 'antrian'));
    }

    public function temuDokterStore(Request $request)
    {
        $data = $request->validate([
            'idpet'       => 'required|integer',
            'idrole_user' => 'required|integer',
            'act'         => 'nullable|string',
        ]);

        if (($data['act'] ?? '') === 'add') {
            $lastNo = DB::table('temu_dokter')
                ->whereDate('waktu_daftar', today())
                ->max('no_urut');

            $nextNo = (int) $lastNo + 1;

            DB::table('temu_dokter')->insert([
                'idpet'        => $data['idpet'],
                'idrole_user'  => $data['idrole_user'],
                'no_urut'      => $nextNo,
                'status'       => 0,
                'waktu_daftar' => now(),
            ]);

            return back()->with('success', 'Pendaftaran berhasil. No. Urut: ' . $nextNo);
        }

        return back();
    }

    public function temuDokterStatus(Request $request)
    {
        $data = $request->validate([
            'idtemu' => 'required|integer',
            'status' => 'required|integer|in:1,2',
        ]);

        DB::table('temu_dokter')
            ->where('idtemu_dokter', $data['idtemu'])
            ->update(['status' => $data['status']]);

        return back()->with('success', 'Status antrian diperbarui.');
    }

    public function registrasiPemilik()
    {
        return view('rshp.Resepsionis.registrasi_pemilik');
    }

    public function registrasiPemilikStore(Request $request)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|max:150',
            'password' => 'required|string|min:3',
            'no_wa'    => 'required|string|max:50',
            'alamat'   => 'required|string',
        ]);

        $userId = DB::table('user')->insertGetId([
            'nama'           => $data['nama'],
            'email'          => $data['email'],
            'password'       => bcrypt($data['password']),
            'remember_token' => null,
        ]);

        DB::table('pemilik')->insert([
            'iduser' => $userId,
            'no_wa'  => $data['no_wa'],
            'alamat' => $data['alamat'],
        ]);

        DB::table('role_user')->insert([
            'iduser' => $userId,
            'idrole' => 5,
            'status' => 1,
        ]);

        return back()->with('success', 'Pemilik berhasil didaftarkan.');
    }

    public function registrasiPet()
    {
        $pemilik_list = DB::table('pemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->select('pemilik.idpemilik', 'user.nama', 'user.email')
            ->orderBy('user.nama')
            ->get();

        $ras_list = DB::table('ras_hewan')
            ->leftJoin('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select(
                'ras_hewan.idras_hewan',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->orderBy('ras_hewan.nama_ras')
            ->get();

        return view('rshp.Resepsionis.registrasi_pet', compact('pemilik_list', 'ras_list'));
    }

    public function registrasiPetStore(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda'   => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:M,F',
            'idpemilik'     => 'required|integer',
            'idras_hewan'   => 'required|integer',
        ]);

        DB::table('pet')->insert([
            'nama'          => $data['nama'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'warna_tanda'   => $data['warna_tanda'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'idpemilik'     => $data['idpemilik'],
            'idras_hewan'   => $data['idras_hewan'],
        ]);

        return back()->with('success', 'Pet berhasil didaftarkan.');
    }
}
