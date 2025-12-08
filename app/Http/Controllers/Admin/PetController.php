<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\Ras;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $list = Pet::with(['pemilik.user', 'ras.jenis'])
            ->when($q !== '', function ($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")
                    ->orWhereHas('pemilik.user', function ($u) use ($q) {
                        $u->where('nama', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%");
                    })
                    ->orWhereHas('ras', function ($r) use ($q) {
                        $r->where('nama_ras', 'like', "%{$q}%");
                    });
            })
            ->orderBy('idpet')
            ->paginate(10)
            ->withQueryString();

        return view('rshp.admin.pet.index', compact('list', 'q'));
    }

    public function create()
    {
        $pemilik = Pemilik::with('user')
            ->orderBy('idpemilik')
            ->get();

        $ras = Ras::with('jenis')
            ->orderBy('nama_ras')
            ->get();

        return view('rshp.admin.pet.create', compact('pemilik', 'ras'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'warna_tanda'   => ['nullable', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:M,F'],
            'idpemilik'     => ['required', 'integer', 'exists:pemilik,idpemilik'],
            'idras_hewan'   => ['required', 'integer', 'exists:ras_hewan,idras_hewan'],
        ]);

        Pet::create($data);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil ditambahkan.');
    }

    public function edit(Pet $pet)
    {
        $pemilik = Pemilik::with('user')
            ->orderBy('idpemilik')
            ->get();

        $ras = Ras::with('jenis')
            ->orderBy('nama_ras')
            ->get();

        return view('rshp.admin.pet.edit', compact('pet', 'pemilik', 'ras'));
    }

    public function update(Request $request, Pet $pet)
    {
        $data = $request->validate([
            'nama'          => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'warna_tanda'   => ['nullable', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:M,F'],
            'idpemilik'     => ['required', 'integer', 'exists:pemilik,idpemilik'],
            'idras_hewan'   => ['required', 'integer', 'exists:ras_hewan,idras_hewan'],
        ]);

        $pet->update($data);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil diperbarui.');
    }

    public function destroy(Pet $pet)
    {
        $pet->deleted_by = auth()->id();
        $pet->save();
        $pet->delete();

        return back()->with('success', 'Pet berhasil dihapus.');
    }
}
