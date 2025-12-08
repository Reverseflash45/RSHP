<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $list = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->whereNull('deleted_at')
            ->when($q !== '', function ($w) use ($q) {
                $w->where('nama_jenis_hewan', 'like', "%{$q}%");
            })
            ->orderBy('idjenis_hewan')
            ->paginate(10)
            ->withQueryString();

        return view('rshp.admin.jenis-hewan.Index', compact('list', 'q'));
    }

    public function create()
    {
        return view('rshp.admin.jenis-hewan.tambah-jenis');
    }

    public function store(Request $request)
    {
        $data = $this->validateJenisHewan($request);

        try {
            $this->createJenisHewan($data);
        } catch (QueryException $e) {
            return back()->withInput()
                ->with('type', 'error')
                ->with('msg', 'Gagal menambah jenis (mungkin duplikat).');
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('type', 'success')
            ->with('msg', 'Jenis hewan berhasil ditambahkan.');
    }

    public function edit(JenisHewan $jenis_hewan)
    {
        return view('rshp.admin.jenis-hewan.Edit-jenis', ['item' => $jenis_hewan]);
    }

    public function update(Request $request, JenisHewan $jenis_hewan)
    {
        $data = $this->validateJenisHewan($request, $jenis_hewan->getKey());

        try {
            $jenis_hewan->update($data);
        } catch (QueryException $e) {
            return back()->withInput()
                ->with('type', 'error')
                ->with('msg', 'Gagal mengubah jenis (mungkin duplikat).');
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('type', 'success')
            ->with('msg', 'Jenis hewan berhasil diubah.');
    }

    public function destroy(JenisHewan $jenis_hewan)
    {
        try {
            DB::table('jenis_hewan')
                ->where('idjenis_hewan', $jenis_hewan->getKey())
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->id(),
                ]);
        } catch (QueryException $e) {
            return back()->with('type', 'error')
                ->with('msg', 'Gagal menghapus (terkait data lain).');
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('type', 'success')
            ->with('msg', 'Jenis hewan berhasil dihapus.');
    }

    protected function formatNamaJenisHewan(string $nama): string
    {
        $nama = trim($nama);
        $nama = strtolower($nama);
        return ucwords($nama);
    }

    protected function validateJenisHewan(Request $request, ?int $id = null): array
    {
        $uniqueRule = Rule::unique('jenis_hewan', 'nama_jenis_hewan');

        if ($id) {
            $uniqueRule = $uniqueRule->ignore($id, 'idjenis_hewan');
        }

        $data = $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule,
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string'   => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max'      => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min'      => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique'   => 'Nama jenis hewan sudah ada.',
        ]);

        $data['nama_jenis_hewan'] = $this->formatNamaJenisHewan($data['nama_jenis_hewan']);

        return $data;
    }

    protected function createJenisHewan(array $data): void
    {
        DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $data['nama_jenis_hewan'],
        ]);
    }
}
