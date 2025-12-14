<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

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

    /* ======================================================
     | CREATE REKAM MEDIS
     ====================================================== */
    public function create($temuId)
    {
        $temu = DB::table('temu_dokter as td')
            ->join('pet as p', 'p.idpet', '=', 'td.idpet')
            ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
            ->join('user as up', 'up.iduser', '=', 'pe.iduser')
            ->where('td.idtemu_dokter', $temuId)
            ->select(
                'td.idtemu_dokter',
                'td.no_urut',
                'td.waktu_daftar',
                'td.idpet',
                'p.nama as nama_pet',
                'up.nama as nama_pemilik'
            )
            ->first();

        if (!$temu) abort(404);

        return view('rshp.Dokter.rekam-medis-create', [
            'namaDokter' => $this->authUserName(),
            'temu' => $temu,
        ]);
    }

    /* ======================================================
     | STORE REKAM MEDIS
     ====================================================== */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idtemu_dokter' => 'required|integer',
            'anamnesa' => 'required|string',
            'diagnosa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'saran_pengobatan' => 'nullable|string',
        ]);

        $temu = DB::table('temu_dokter')
            ->where('idtemu_dokter', $data['idtemu_dokter'])
            ->first();

        if (!$temu) {
            return back()->withInput()->with('error', 'Data temu dokter tidak ditemukan.');
        }

        try {
            DB::table('rekam_medis')->insert([
                'idpet' => $temu->idpet,
                'dokter_pemeriksa' => $temu->idrole_user,
                'anamnesa' => $data['anamnesa'],
                'diagnosa' => $data['diagnosa'],
                'temuan_klinis' => $data['temuan_klinis'] ?? null,
                'saran_pengobatan' => $data['saran_pengobatan'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('temu_dokter')
                ->where('idtemu_dokter', $data['idtemu_dokter'])
                ->update(['status' => 2]);

            return redirect()->route('dokter.rekam-medis')
                ->with('success', 'Rekam medis berhasil disimpan.');

        } catch (QueryException $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan rekam medis.');
        }
    }

    /* ======================================================
     | TRANSAKSI DOKTER
     ====================================================== */
    public function transaksiIndex()
    {
        $userId = auth()->id();
        
        $dokterRole = DB::table('role_user')
            ->where('iduser', $userId)
            ->where('idrole', 2)
            ->first();

        if (!$dokterRole) {
            return redirect()->route('dokter.dashboard')
                ->with('error', 'Anda bukan dokter.');
        }

        $transaksi = DB::table('transaksi_dokter as td')
            ->join('rekam_medis as rm', 'rm.idrekam_medis', '=', 'td.idrekam_medis')
            ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
            ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
            ->join('user as up', 'up.iduser', '=', 'pe.iduser')
            ->where('rm.dokter_pemeriksa', $dokterRole->idrole_user)
            ->select(
                'td.idtransaksi_dokter',
                'td.jenis_layanan',
                'td.biaya',
                'td.status',
                'td.created_at',
                'rm.idrekam_medis',
                'p.nama as nama_pet',
                'up.nama as nama_pemilik',
                'rm.diagnosa'
            )
            ->orderByDesc('td.idtransaksi_dokter')
            ->get();

        return view('rshp.Dokter.transaksi_index', [
            'namaDokter' => $this->authUserName(),
            'transaksi' => $transaksi,
        ]);
    }

    public function transaksiCreate(Request $request)
    {
        $rekamId = $request->query('idrekam', 0);
        $userId = auth()->id();
        
        $dokterRole = DB::table('role_user')
            ->where('iduser', $userId)
            ->where('idrole', 2)
            ->first();

        $rekamList = DB::table('rekam_medis as rm')
            ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
            ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
            ->join('user as up', 'up.iduser', '=', 'pe.iduser')
            ->leftJoin('transaksi_dokter as td', function($join) {
                $join->on('td.idrekam_medis', '=', 'rm.idrekam_medis')
                     ->where('td.status', '!=', 'selesai');
            })
            ->where('rm.dokter_pemeriksa', $dokterRole->idrole_user)
            ->whereNull('td.idtransaksi_dokter')
            ->select(
                'rm.idrekam_medis',
                'rm.created_at',
                'rm.diagnosa',
                'p.nama as nama_pet',
                'up.nama as nama_pemilik'
            )
            ->orderByDesc('rm.idrekam_medis')
            ->limit(50)
            ->get();

        $selectedRekam = null;
        if ($rekamId) {
            $selectedRekam = DB::table('rekam_medis as rm')
                ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
                ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
                ->join('user as up', 'up.iduser', '=', 'pe.iduser')
                ->where('rm.idrekam_medis', $rekamId)
                ->where('rm.dokter_pemeriksa', $dokterRole->idrole_user)
                ->select(
                    'rm.idrekam_medis',
                    'rm.created_at',
                    'rm.diagnosa',
                    'rm.anamnesa',
                    'p.nama as nama_pet',
                    'up.nama as nama_pemilik'
                )
                ->first();
        }

        $jenisLayanan = [
            'konsultasi' => 'Konsultasi',
            'pemeriksaan' => 'Pemeriksaan',
            'tindakan_medis' => 'Tindakan Medis',
            'operasi' => 'Operasi',
            'pengobatan' => 'Pengobatan',
        ];

        return view('rshp.Dokter.transaksi_create', [
            'namaDokter' => $this->authUserName(),
            'rekamList' => $rekamList,
            'selectedRekam' => $selectedRekam,
            'rekamId' => $rekamId,
            'jenisLayanan' => $jenisLayanan,
        ]);
    }

    /* ======================================================
     | STORE TRANSAKSI DOKTER
     ====================================================== */
    public function transaksiStore(Request $request)
    {
        $userId = auth()->id();
        
        $dokterRole = DB::table('role_user')
            ->where('iduser', $userId)
            ->where('idrole', 2)
            ->first();

        $data = $request->validate([
            'idrekam_medis' => 'required|integer|exists:rekam_medis,idrekam_medis',
            'jenis_layanan' => 'required|string|max:100',
            'biaya' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            $rekamMedis = DB::table('rekam_medis')
                ->where('idrekam_medis', $data['idrekam_medis'])
                ->where('dokter_pemeriksa', $dokterRole->idrole_user)
                ->first();

            if (!$rekamMedis) {
                return back()->withInput()->with('error', 'Anda tidak berhak membuat transaksi untuk rekam medis ini.');
            }

            $existing = DB::table('transaksi_dokter')
                ->where('idrekam_medis', $data['idrekam_medis'])
                ->where('status', '!=', 'selesai')
                ->first();

            if ($existing) {
                return back()->withInput()->with('error', 'Sudah ada transaksi aktif untuk rekam medis ini.');
            }

            DB::table('transaksi_dokter')->insert([
                'idrekam_medis' => $data['idrekam_medis'],
                'jenis_layanan' => $data['jenis_layanan'],
                'biaya' => $data['biaya'],
                'keterangan' => $data['keterangan'] ?? null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('dokter.transaksi.index')
                ->with('success', 'Transaksi berhasil dibuat.');

        } catch (QueryException $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function transaksiDetail($id)
    {
        $userId = auth()->id();
        
        $dokterRole = DB::table('role_user')
            ->where('iduser', $userId)
            ->where('idrole', 2)
            ->first();

        $transaksi = DB::table('transaksi_dokter as td')
            ->join('rekam_medis as rm', 'rm.idrekam_medis', '=', 'td.idrekam_medis')
            ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
            ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
            ->join('user as up', 'up.iduser', '=', 'pe.iduser')
            ->where('td.idtransaksi_dokter', $id)
            ->where('rm.dokter_pemeriksa', $dokterRole->idrole_user)
            ->select(
                'td.idtransaksi_dokter',
                'td.jenis_layanan',
                'td.biaya',
                'td.keterangan',
                'td.status',
                'td.created_at',
                'td.updated_at',
                'rm.idrekam_medis',
                'rm.anamnesa',
                'rm.diagnosa',
                'rm.temuan_klinis',
                'p.nama as nama_pet',
                'up.nama as nama_pemilik'
            )
            ->first();

        if (!$transaksi) abort(404);

        return view('rshp.Dokter.transaksi_detail', [
            'namaDokter' => $this->authUserName(),
            'transaksi' => $transaksi,
        ]);
    }
}