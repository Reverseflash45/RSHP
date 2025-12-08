<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $sort = $request->query('sort', 'id');
        $dir = $request->query('dir', 'asc');

        $sortMap = [
            'id'    => 'r.idras_hewan',
            'nama'  => 'r.nama_ras',
            'jenis' => 'j.nama_jenis_hewan',
        ];

        if (! isset($sortMap[$sort])) {
            $sort = 'id';
        }

        $dir = strtolower($dir) === 'desc' ? 'desc' : 'asc';

        $query = DB::table('ras_hewan as r')
            ->join('jenis_hewan as j', 'j.idjenis_hewan', '=', 'r.idjenis_hewan')
            ->select('r.idras_hewan', 'r.nama_ras', 'j.nama_jenis_hewan', 'r.idjenis_hewan')
            ->whereNull('r.deleted_at');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('r.nama_ras', 'like', '%' . $search . '%')
                  ->orWhere('j.nama_jenis_hewan', 'like', '%' . $search . '%')
                  ->orWhere('r.idras_hewan', 'like', '%' . $search . '%');
            });
        }

        $query->orderBy($sortMap[$sort], $dir)
              ->orderBy('r.nama_ras');

        $list = $query->get();

        $ras = $list->groupBy('nama_jenis_hewan');

        return view('rshp.admin.ras.index', [
            'ras'    => $ras,
            'search' => $search,
            'sort'   => $sort,
            'dir'    => $dir,
        ]);
    }

    public function create()
    {
        $jenisHewan = DB::table('jenis_hewan')
            ->whereNull('deleted_at')
            ->orderBy('nama_jenis_hewan')
            ->get();

        return view('rshp.admin.ras.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_ras'       => 'required|string|max:100',
            'idjenis_hewan'  => 'required|integer',
        ]);

        DB::table('ras_hewan')->insert([
            'nama_ras'      => $data['nama_ras'],
            'idjenis_hewan' => $data['idjenis_hewan'],
        ]);

        return redirect()->route('admin.ras.index')
            ->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ras = DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->whereNull('deleted_at')
            ->first();

        if (! $ras) {
            abort(404);
        }

        $jenisHewan = DB::table('jenis_hewan')
            ->whereNull('deleted_at')
            ->orderBy('nama_jenis_hewan')
            ->get();

        return view('rshp.admin.ras.edit', compact('ras', 'jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_ras'       => 'required|string|max:100',
            'idjenis_hewan'  => 'required|integer',
        ]);

        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->whereNull('deleted_at')
            ->update([
                'nama_ras'      => $data['nama_ras'],
                'idjenis_hewan' => $data['idjenis_hewan'],
            ]);

        return redirect()->route('admin.ras.index')
            ->with('success', 'Ras hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' => now(),
                'deleted_by' => auth()->id(),
            ]);

        return redirect()->route('admin.ras.index')
            ->with('success', 'Ras hewan berhasil dihapus.');
    }
}
