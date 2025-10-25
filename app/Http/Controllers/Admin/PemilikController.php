<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        // kirim paginator supaya bisa pakai links(); kalau mau tanpa pagination, ganti ->paginate(10) jadi ->get()
        $list = Pemilik::with('user')->orderBy('idpemilik')->paginate(10);

        return view('rshp.admin.pemilik.index', compact('list'));
    }

    public function update(\Illuminate\Http\Request $request, Pemilik $pemilik)
    {
        $data = $request->validate([
            'nama'   => ['required','string','max:100'],
            'email'  => ['required','email'],
            'no_wa'  => ['nullable','string','max:50'],
            'alamat' => ['nullable','string','max:255'],
        ]);

        $pemilik->update($data);

        return back()->with('type','success')->with('msg','Perubahan data tersimpan.');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'nama'     => ['required','string','max:100'],
            'email'    => ['required','email','max:100'],
            'password' => ['required','string','min:6'],
            'no_wa'    => ['required','string','max:50'],
            'alamat'   => ['required','string','max:255'],
        ]);

        // Sesuaikan dengan skema modelmu
        $data['password'] = bcrypt($data['password']);
        Pemilik::create($data);

        return back()->with('type','success')->with('msg','Pemilik berhasil ditambahkan.');
    }
}
