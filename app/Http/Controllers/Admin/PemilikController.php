<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $list = Pemilik::with('user')
            ->when($q !== '', function ($w) use ($q) {
                $w->whereHas('user', function ($u) use ($q) {
                        $u->where('nama', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%");
                    })
                  ->orWhere('no_wa', 'like', "%{$q}%")
                  ->orWhere('alamat', 'like', "%{$q}%");
            })
            ->orderBy('idpemilik')
            ->paginate(10)
            ->withQueryString();

        return view('rshp.admin.pemilik.index', compact('list', 'q'));
    }

    public function create()
    {
        return view('rshp.admin.pemilik.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:100', 'unique:user,email'],
            'password' => ['required', 'string', 'min:6'],
            'no_wa'    => ['required', 'string', 'max:50'],
            'alamat'   => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Pemilik::create([
            'no_wa'   => $data['no_wa'],
            'alamat'  => $data['alamat'],
            'iduser'  => $user->iduser,
        ]);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function edit(Pemilik $pemilik)
    {
        return view('rshp.admin.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, Pemilik $pemilik)
    {
        $validated = $request->validate([
            'nama'   => ['required', 'string', 'max:100'],
            'email'  => ['required', 'email'],
            'no_wa'  => ['nullable', 'string', 'max:50'],
            'alamat' => ['nullable', 'string', 'max:255'],
        ]);

        $pemilik->update([
            'no_wa'  => $validated['no_wa'] ?? $pemilik->no_wa,
            'alamat'=> $validated['alamat'] ?? $pemilik->alamat,
        ]);

        if ($pemilik->user) {
            $pemilik->user->update([
                'nama'  => $validated['nama'],
                'email'=> $validated['email'],
            ]);
        }

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Perubahan data tersimpan.');
    }

    public function destroy(Pemilik $pemilik)
    {
        $pemilik->deleted_by = auth()->id();
        $pemilik->save();
        $pemilik->delete();

        return back()->with('success', 'Pemilik berhasil dihapus.');
    }
}
