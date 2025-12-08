<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $q    = trim((string) $request->get('q', ''));
        $sort = $request->get('sort', 'id');
        $dir  = $request->get('dir', 'asc');

        $sortMap = [
            'id'   => 'idkategori',
            'nama' => 'nama_kategori',
        ];

        if (! isset($sortMap[$sort])) {
            $sort = 'id';
        }

        $dir = strtolower($dir) === 'desc' ? 'desc' : 'asc';

        $list = Kategori::query()
            ->when($q !== '', function ($w) use ($q) {
                $w->where('nama_kategori', 'like', "%{$q}%");
            })
            ->orderBy($sortMap[$sort], $dir)
            ->paginate(10)
            ->withQueryString();

        return view('rshp.admin.kategori.index', [
            'list' => $list,
            'q'    => $q,
            'sort' => $sort,
            'dir'  => $dir,
        ]);
    }

    public function create()
    {
        return view('rshp.admin.kategori.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori', 'nama_kategori')
                    ->whereNull('deleted_at'),
            ],
        ]);

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('rshp.admin.kategori.edit', [
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori', 'nama_kategori')
                    ->ignore($kategori->idkategori, 'idkategori')
                    ->whereNull('deleted_at'),
            ],
        ]);

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if (auth()->check()) {
            $kategori->deleted_by = auth()->id();
            $kategori->save();
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
