<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    protected function authUserName(): string
    {
        $u = auth()->user();
        return (string)($u->nama ?? $u->name ?? 'Dokter');
    }

    /* ======================================================
     | DASHBOARD
     ====================================================== */
    public function dashboard()
    {
        return view('rshp.Dokter.dashboard', [
            'namaDokter' => $this->authUserName(),
        ]);
    }

    /* ======================================================
     | TEMU DOKTER
     ====================================================== */
    public function temuDokter()
    {
        // NOTE: ini versi aman biar halaman kebuka dulu.
        // Kalau mau difilter per dokter (role_user), nanti kita rapihin lagi.
        $temuDokter = DB::table('temu_dokter as td')
            ->join('pet as p', 'p.idpet', '=', 'td.idpet')
            ->select(
                'td.idtemu_dokter',
                'td.no_urut',
                'td.waktu_daftar',
                'td.status',
                'p.nama as nama_pet'
            )
            ->orderBy('td.no_urut')
            ->get();

        return view('rshp.Dokter.temu-dokter', [
            'namaDokter' => $this->authUserName(),
            'temuDokter' => $temuDokter,
        ]);
    }

    /* ======================================================
     | REKAM MEDIS
     ====================================================== */
    public function rekamMedis()
    {
        // FIX error kamu: pastikan SELECT ada "nama_pet"
        $rekamMedis = DB::table('rekam_medis as rm')
            ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
            ->select(
                'rm.idrekam_medis',
                'rm.created_at',
                'rm.anamnesa',
                'rm.diagnosa',
                'p.nama as nama_pet'
            )
            ->orderByDesc('rm.idrekam_medis')
            ->limit(50)
            ->get();

        return view('rshp.Dokter.rekam-medis', [
            'namaDokter' => $this->authUserName(),
            'rekamMedis' => $rekamMedis,
        ]);
    }
}
