<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PerawatController extends Controller
{
    protected function authUserName(): string
    {
        $u = auth()->user();
        return (string) ($u->nama ?? $u->name ?? 'Perawat');
    }

    public function dashboard()
    {
        return view('rshp.Perawat.dashboard', [
            'namaPerawat' => $this->authUserName(),
        ]);
    }

    public function rekamMedisIndex()
    {
        // 1) reservasi hari ini yang belum punya RM (berdasarkan pet + tanggal)
        $reservasi = DB::table('temu_dokter as td')
            ->join('pet as p', 'p.idpet', '=', 'td.idpet')
            ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
            ->join('user as up', 'up.iduser', '=', 'pe.iduser')
            ->join('role_user as ru', 'ru.idrole_user', '=', 'td.idrole_user')
            ->join('user as ud', 'ud.iduser', '=', 'ru.iduser')
            ->whereDate('td.waktu_daftar', today())
            ->whereNotExists(function ($q) {
                $q->select(DB::raw(1))
                  ->from('rekam_medis as rm')
                  ->whereColumn('rm.idpet', 'td.idpet')
                  ->whereRaw('DATE(rm.created_at) = DATE(td.waktu_daftar)');
            })
            ->select(
                'td.idtemu_dokter',
                'td.no_urut',
                'td.waktu_daftar',
                'td.status',
                'td.idpet',
                'td.idrole_user',
                'p.nama as nama_pet',
                'up.nama as nama_pemilik',
                'ud.nama as nama_dokter'
            )
            ->orderBy('td.no_urut')
            ->get();

        // 2) list RM terbaru
        $listRM = DB::table('rekam_medis as rm')
            ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
            ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
            ->join('user as up', 'up.iduser', '=', 'pe.iduser')
            ->leftJoin('role_user as ru', 'ru.idrole_user', '=', 'rm.dokter_pemeriksa')
            ->leftJoin('user as ud', 'ud.iduser', '=', 'ru.iduser')
            ->select(
                'rm.idrekam_medis',
                'rm.created_at',
                'rm.anamnesa',
                'rm.diagnosa',
                'rm.temuan_klinis',
                'p.nama as nama_pet',
                'up.nama as nama_pemilik',
                'ud.nama as nama_dokter'
            )
            ->orderByDesc('rm.idrekam_medis')
            ->limit(50)
            ->get();

        return view('rshp.Perawat.rekam_medis_index', [
            'namaPerawat' => $this->authUserName(),
            'reservasi'   => $reservasi,
            'listRM'      => $listRM,
        ]);
    }

    public function rekamMedisCreate(Request $request)
    {
        $temuId = (int) $request->query('idtemu');

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

        return view('rshp.Perawat.rekam_medis_create', [
            'namaPerawat' => $this->authUserName(),
            'temu'        => $temu,
        ]);
    }

    public function rekamMedisStore(Request $request)
    {
        $data = $request->validate([
            'idtemu_dokter' => 'required|integer',
            'anamnesa'      => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa'      => 'required|string',
        ]);

        $temu = DB::table('temu_dokter')
            ->where('idtemu_dokter', (int) $data['idtemu_dokter'])
            ->select('idtemu_dokter', 'idpet', 'idrole_user', 'waktu_daftar')
            ->first();

        if (!$temu) {
            return back()->withInput()->with('err', 'Reservasi tidak ditemukan.');
        }

        try {
            DB::table('rekam_medis')->insert([
                'idpet'            => (int) $temu->idpet,
                'dokter_pemeriksa' => (int) $temu->idrole_user,
                'anamnesa'         => $data['anamnesa'],
                'temuan_klinis'    => $data['temuan_klinis'] ?? null,
                'diagnosa'         => $data['diagnosa'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->with('err', 'Gagal menyimpan rekam medis.');
        }

        return redirect()->route('perawat.rekam-medis.index')
            ->with('msg', 'Rekam medis berhasil disimpan.');
    }

    public function rekamMedisDetail($id)
    {
        $id = (int) $id;

        $header = DB::table('rekam_medis as rm')
            ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
            ->join('pemilik as pe', 'pe.idpemilik', '=', 'p.idpemilik')
            ->join('user as up', 'up.iduser', '=', 'pe.iduser')
            ->where('rm.idrekam_medis', $id)
            ->select(
                'rm.idrekam_medis',
                'rm.anamnesa',
                'rm.temuan_klinis',
                'rm.diagnosa',
                'p.nama as nama_pet',
                'up.nama as nama_pemilik'
            )
            ->first();

        if (!$header) abort(404);

        $detailTindakan = DB::table('detail_rekam_medis as drm')
            ->join('kode_tindakan_terapi as ktt', 'ktt.idkode_tindakan_terapi', '=', 'drm.idkode_tindakan_terapi')
            ->leftJoin('kategori as kat', 'kat.idkategori', '=', 'ktt.idkategori')
            ->leftJoin('kategori_klinis as kk', 'kk.idkategori_klinis', '=', 'ktt.idkategori_klinis')
            ->where('drm.idrekam_medis', $id)
            ->select(
                'drm.iddetail_rekam_medis',
                'drm.idkode_tindakan_terapi',
                'drm.detail',
                'ktt.kode',
                'ktt.deskripsi_tindakan_terapi',
                'kat.nama_kategori',
                'kk.nama_kategori_klinis'
            )
            ->orderBy('drm.iddetail_rekam_medis')
            ->get();

        $listKode = DB::table('kode_tindakan_terapi')
            ->select('idkode_tindakan_terapi', 'kode', 'deskripsi_tindakan_terapi')
            ->orderBy('kode')
            ->get()
            ->map(function ($r) {
                return [
                    'idkode_tindakan_terapi' => $r->idkode_tindakan_terapi,
                    'label' => $r->kode . ' - ' . $r->deskripsi_tindakan_terapi,
                ];
            });

        return view('rshp.Perawat.rekam_medis_detail', [
            'namaPerawat'   => $this->authUserName(),
            'idRekam'       => $id,
            'header'        => (array) $header,
            'detailTindakan'=> $detailTindakan->map(fn($x)=> (array)$x)->all(),
            'listKode'      => $listKode->all(),
            'msg'           => session('msg'),
            'ok'            => session('ok'),
        ]);
    }

    public function rekamMedisUpdateHeader(Request $request, $id)
    {
        $id = (int) $id;

        $data = $request->validate([
            'anamnesa'      => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa'      => 'nullable|string',
        ]);

        DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->update([
                'anamnesa'      => $data['anamnesa'] ?? null,
                'temuan_klinis' => $data['temuan_klinis'] ?? null,
                'diagnosa'      => $data['diagnosa'] ?? null,
                'updated_at'    => now(),
            ]);

        return back()->with(['ok'=>1,'msg'=>'Header rekam medis tersimpan.']);
    }

    public function detailAdd(Request $request, $id)
    {
        $id = (int) $id;

        $data = $request->validate([
            'idkode_tindakan_terapi' => 'required|integer',
            'detail' => 'nullable|string',
        ]);

        DB::table('detail_rekam_medis')->insert([
            'idrekam_medis' => $id,
            'idkode_tindakan_terapi' => (int) $data['idkode_tindakan_terapi'],
            'detail' => $data['detail'] ?? null,
        ]);

        return back()->with(['ok'=>1,'msg'=>'Tindakan ditambahkan.']);
    }

    public function detailUpdate(Request $request, $id)
    {
        $id = (int) $id;

        $data = $request->validate([
            'iddetail' => 'required|integer',
            'idkode_tindakan_terapi' => 'required|integer',
            'detail' => 'nullable|string',
        ]);

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', (int)$data['iddetail'])
            ->where('idrekam_medis', $id)
            ->update([
                'idkode_tindakan_terapi' => (int)$data['idkode_tindakan_terapi'],
                'detail' => $data['detail'] ?? null,
            ]);

        return back()->with(['ok'=>1,'msg'=>'Tindakan diperbarui.']);
    }

    public function detailDelete(Request $request, $id)
    {
        $id = (int) $id;

        $data = $request->validate([
            'iddetail' => 'required|integer',
        ]);

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', (int)$data['iddetail'])
            ->where('idrekam_medis', $id)
            ->delete();

        return back()->with(['ok'=>1,'msg'=>'Tindakan dihapus.']);
    }
}
