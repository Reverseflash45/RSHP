<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class JenisHewanController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $list = JenisHewan::when($q !== '', fn($w) => $w->where('nama_jenis_hewan', 'like', "%{$q}%"))
            ->orderBy('idjenis_hewan')
            ->paginate(10)
            ->withQueryString();

        return view('rshp.admin.jenis-hewan.index', compact('list'));
    }

    public function create()
    {
        return view('rshp.admin.jenis-hewan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jenis_hewan' => ['required','string','max:100', Rule::unique('jenis_hewan','nama_jenis_hewan')],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis tidak boleh kosong.',
            'nama_jenis_hewan.unique'   => 'Nama jenis sudah ada.',
        ]);

        $data['nama_jenis_hewan'] = trim($data['nama_jenis_hewan']);

        try {
            JenisHewan::create($data);
        } catch (QueryException $e) {
            return back()->withInput()
                ->with('type','error')->with('msg','Gagal menambah jenis (mungkin duplikat).');
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('type','success')->with('msg','Jenis hewan berhasil ditambahkan.');
    }

    public function edit(JenisHewan $jenis_hewan)
    {
        return view('rshp.admin.jenis-hewan.edit', ['item' => $jenis_hewan]);
    }

    public function update(Request $request, JenisHewan $jenis_hewan)
    {
        $data = $request->validate([
            'nama_jenis_hewan' => [
                'required','string','max:100',
                Rule::unique('jenis_hewan','nama_jenis_hewan')->ignore($jenis_hewan->getKey(), $jenis_hewan->getKeyName()),
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis tidak boleh kosong.',
            'nama_jenis_hewan.unique'   => 'Nama jenis sudah ada.',
        ]);

        $data['nama_jenis_hewan'] = trim($data['nama_jenis_hewan']);

        try {
            $jenis_hewan->update($data);
        } catch (QueryException $e) {
            return back()->withInput()
                ->with('type','error')->with('msg','Gagal mengubah jenis (mungkin duplikat).');
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('type','success')->with('msg','Jenis hewan berhasil diubah.');
    }

    public function destroy(JenisHewan $jenis_hewan)
    {
        try {
            $jenis_hewan->delete();
        } catch (QueryException $e) {
            return back()->with('type','error')->with('msg','Gagal menghapus (terkait data lain).');
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('type','success')->with('msg','Jenis hewan berhasil dihapus.');
    }
}
