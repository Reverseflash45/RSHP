<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KodeTindakanController extends Controller
{
    public function index(Request $request)
    {
        $q          = trim((string) $request->get('q', ''));
        $kategoriId = $request->get('kategori');
        $klinisId   = $request->get('klinis');
        $sort       = $request->get('sort', 'kode');
        $dir        = $request->get('dir', 'asc');

        $sortMap = [
            'id'       => 'kode_tindakan_terapi.idkode_tindakan_terapi',
            'kode'     => 'kode_tindakan_terapi.kode',
            'kategori' => 'kat.nama_kategori',
            'klinis'   => 'kk.nama_kategori_klinis',
        ];

        if (! isset($sortMap[$sort])) {
            $sort = 'kode';
        }

        $dir = strtolower($dir) === 'desc' ? 'desc' : 'asc';

        $query = KodeTindakan::query()
            ->leftJoin('kategori as kat', 'kat.idkategori', '=', 'kode_tindakan_terapi.idkategori')
            ->leftJoin('kategori_klinis as kk', 'kk.idkategori_klinis', '=', 'kode_tindakan_terapi.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.idkode_tindakan_terapi',
                'kode_tindakan_terapi.kode',
                'kode_tindakan_terapi.deskripsi_tindakan_terapi',
                'kode_tindakan_terapi.idkategori',
                'kode_tindakan_terapi.idkategori_klinis',
                'kat.nama_kategori',
                'kk.nama_kategori_klinis'
            );

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('kode_tindakan_terapi.kode', 'like', "%{$q}%")
                  ->orWhere('kode_tindakan_terapi.deskripsi_tindakan_terapi', 'like', "%{$q}%")
                  ->orWhere('kat.nama_kategori', 'like', "%{$q}%")
                  ->orWhere('kk.nama_kategori_klinis', 'like', "%{$q}%");
            });
        }

        if ($kategoriId) {
            $query->where('kode_tindakan_terapi.idkategori', $kategoriId);
        }

        if ($klinisId) {
            $query->where('kode_tindakan_terapi.idkategori_klinis', $klinisId);
        }

        $list = $query
            ->orderBy($sortMap[$sort], $dir)
            ->orderBy('kode_tindakan_terapi.kode')
            ->paginate(10)
            ->withQueryString();

        $kategori = Kategori::orderBy('nama_kategori')->get();
        $klinis   = KategoriKlinis::orderBy('nama_kategori_klinis')->get();

        return view('rshp.admin.kode-tindakan.index', [
            'list'       => $list,
            'q'          => $q,
            'sort'       => $sort,
            'dir'        => $dir,
            'kategori'   => $kategori,
            'klinis'     => $klinis,
            'kategoriId' => $kategoriId,
            'klinisId'   => $klinisId,
        ]);
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $klinis   = KategoriKlinis::orderBy('nama_kategori_klinis')->get();

        return view('rshp.admin.kode-tindakan.create', compact('kategori', 'klinis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode'                      => [
                'required',
                'string',
                'max:5',
                Rule::unique('kode_tindakan_terapi', 'kode')->whereNull('deleted_at'),
            ],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:1000'],
            'idkategori'                => ['required', 'integer', 'exists:kategori,idkategori'],
            'idkategori_klinis'         => ['required', 'integer', 'exists:kategori_klinis,idkategori_klinis'],
        ]);

        KodeTindakan::create($data);

        return redirect()->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan berhasil ditambahkan.');
    }

    public function edit(KodeTindakan $kode_tindakan)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $klinis   = KategoriKlinis::orderBy('nama_kategori_klinis')->get();

        return view('rshp.admin.kode-tindakan.edit', [
            'item'     => $kode_tindakan,
            'kategori' => $kategori,
            'klinis'   => $klinis,
        ]);
    }

    public function update(Request $request, KodeTindakan $kode_tindakan)
    {
        $data = $request->validate([
            'kode'                      => [
                'required',
                'string',
                'max:5',
                Rule::unique('kode_tindakan_terapi', 'kode')
                    ->ignore($kode_tindakan->idkode_tindakan_terapi, 'idkode_tindakan_terapi')
                    ->whereNull('deleted_at'),
            ],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:1000'],
            'idkategori'                => ['required', 'integer', 'exists:kategori,idkategori'],
            'idkategori_klinis'         => ['required', 'integer', 'exists:kategori_klinis,idkategori_klinis'],
        ]);

        $kode_tindakan->update($data);

        return redirect()->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan berhasil diperbarui.');
    }

    public function destroy(KodeTindakan $kode_tindakan)
    {
        if (auth()->check()) {
            $kode_tindakan->deleted_by = auth()->id();
            $kode_tindakan->save();
        }

        $kode_tindakan->delete();

        return back()->with('success', 'Kode tindakan berhasil dihapus.');
    }
}
