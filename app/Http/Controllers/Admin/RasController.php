<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ras;

class RasController extends Controller
{
    public function index()
    {
        // Ambil data Ras + relasi ke Jenis Hewan
        $daftarRas = Ras::with('jenis')
            ->orderBy('idjenis_hewan')
            ->orderBy('nama_ras')
            ->get();

        // Sesuaikan path view jika kamu pakai folder "Ras Hewan"
        return view('rshp.admin.Ras Hewan.Index', compact('daftarRas'));
    }
}