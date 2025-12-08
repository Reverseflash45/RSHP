<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriKlinisController extends Controller
{
    public function index(Request $request)
    {
        $q    = trim((string) $request->get('q', ''));
        $sort = $request->get('sort', 'id');
        $dir  = $request->get('dir', 'asc');

        $sortMap = [
            'id'   => 'idkategori_klinis',
            'nama' => 'nama_kategori_klinis',
        ];

        if (! isset($sortMap[$sort])) {
            $sort = 'id';
        }

        $dir = strtolower($dir) === 'desc' ? 'desc' : 'asc';

        $list = KategoriKlinis::query()
            ->when($q !== '', function ($w) use ($q) {
                $w->where('nama_kategori_klinis', 'like', "%{$q}%");
            })
            ->orderBy($sortMap[$sort], $dir)
            ->paginate(10)
            ->withQueryString();

        return view('rshp.admin.kategori-klinis.index', [
            'list' => $list,
            'q'    => $q,
            'sort' => $sort,
            'dir'  => $dir,
        ]);
    }

    public function create()
    {
        return view('rshp.admin.kategori-klinis.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori_klinis', 'nama_kategori_klinis')
                    ->whereNull('deleted_at'),
            ],
        ]);

        KategoriKlinis::create($data);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil ditambahkan.');
    }

    public function edit(KategoriKlinis $kategori_klini)
    {
        return view('rshp.admin.kategori-klinis.edit', [
            'item' => $kategori_klini,
        ]);
    }

    public function update(Request $request, KategoriKlinis $kategori_klini)
    {
        $data = $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori_klinis', 'nama_kategori_klinis')
                    ->ignore($kategori_klini->idkategori_klinis, 'idkategori_klinis')
                    ->whereNull('deleted_at'),
            ],
        ]);

        $kategori_klini->update($data);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil diperbarui.');
    }

    public function destroy(KategoriKlinis $kategori_klini)
    {
        if (auth()->check()) {
            $kategori_klini->deleted_by = auth()->id();
            $kategori_klini->save();
        }

        $kategori_klini->delete();

        return back()->with('success', 'Kategori klinis berhasil dihapus.');
    }
}
