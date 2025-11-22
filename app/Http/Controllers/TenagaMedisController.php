<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Perawat;

class TenagaMedisController extends Controller
{
    public function createDokter()
    {
        return view('tenaga-medis.dokter.create');
    }

    public function storeDokter(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'bidang_dokter' => 'required|string|max:100',
            'jenis_kelamin' => 'required|string|max:10',
            'id_user' => 'required|exists:users,id',
        ]);

        Dokter::create($request->all());

        return redirect()->back()->with('msg', 'Data dokter berhasil disimpan.');
    }

    public function createPerawat()
    {
        return view('tenaga-medis.perawat.create');
    }

    public function storePerawat(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'jenis_kelamin' => 'required|string|max:10',
            'id_user' => 'required|exists:users,id',
        ]);

        Perawat::create($request->all());

        return redirect()->back()->with('msg', 'Data perawat berhasil disimpan.');
    }
}