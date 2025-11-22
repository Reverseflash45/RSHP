<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use App\Models\TindakanTerapi;

class RekamMedisController extends Controller
{
    public function dashboard()
    {
        $dokterId = auth()->user()->iduser;

        $temuDokter = TemuDokter::where('id_dokter', $dokterId)
            ->whereDate('waktu_daftar', now())
            ->get();

        $rekamMedis = RekamMedis::where('id_dokter', $dokterId)->latest()->get();

        $listTindakan = TindakanTerapi::whereIn('idrekam_medis', $rekamMedis->pluck('idrekam_medis'))->get()
            ->groupBy('idrekam_medis');

        return view('rshp.dokter.dashboard', compact('temuDokter', 'rekamMedis', 'listTindakan'));
    }

    public function create($temuId)
    {
        return view('rshp.dokter.rekam-medis.create', compact('temuId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idtemu_dokter' => 'required|exists:temu_dokter,idtemu_dokter',
            'anamnesa' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        RekamMedis::create([
            'idtemu_dokter' => $request->idtemu_dokter,
            'id_dokter' => auth()->user()->iduser,
            'anamnesa' => $request->anamnesa,
            'diagnosa' => $request->diagnosa,
        ]);

        return redirect()->route('dokter.dashboard')->with([
            'msg' => 'Rekam medis berhasil disimpan.',
            'type' => 'success'
        ]);
    }
}