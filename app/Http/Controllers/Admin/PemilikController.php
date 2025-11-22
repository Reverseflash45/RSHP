<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $list = Pemilik::orderBy('idpemilik')->paginate(10);
        return view('rshp.admin.pemilik.index', compact('list'));
    }

    public function create()
    {
        return view('rshp.admin.pemilik.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => ['required','string','max:100'],
            'email'    => ['required','email','max:100','unique:users,email'],
            'password' => ['required','string','min:6'],
            'no_wa'    => ['required','string','max:50'],
            'alamat'   => ['required','string','max:255'],
        ]);

        // ✅ FIX: Tambahkan 'name' saat membuat user
        $user = User::create([
            'name'     => $data['nama'], // ← WAJIB untuk hindari error SQL
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Pemilik::create([
            'nama'    => $data['nama'],
            'email'   => $data['email'],
            'no_wa'   => $data['no_wa'],
            'alamat'  => $data['alamat'],
            'iduser'  => $user->id,
        ]);

        return redirect()->route('admin.pemilik.index')
            ->with('success','Pemilik berhasil ditambahkan.');
    }

    public function update(Request $request, Pemilik $pemilik)
    {
        $validated = $request->validate([
            'nama'   => ['required','string','max:100'],
            'email'  => ['required','email'],
            'no_wa'  => ['nullable','string','max:50'],
            'alamat' => ['nullable','string','max:255'],
        ]);

        $pemilik->update($validated);

        return back()->with('success','Perubahan data tersimpan.');
    }

    public function destroy(Pemilik $pemilik)
    {
        $pemilik->delete();
        return back()->with('success','Pemilik berhasil dihapus.');
    }
}