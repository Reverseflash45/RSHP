<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Ras Hewan</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f9f9f9;color:#111827}

.header{background:#fff;text-align:center;padding:10px}
.header img{height:72px}

nav{background:#f5b301}
nav .wrap{max-width:1100px;margin:0 auto;padding:12px 16px;display:flex;gap:16px;align-items:center}
nav a, nav button{color:#fff;font-weight:700;text-decoration:none;padding:6px 10px;border:none;background:transparent;cursor:pointer;border-radius:4px}
nav a:hover, nav button:hover{background:rgba(255,255,255,.2)}

.main{max-width:1100px;margin:28px auto;padding:0 16px}
.panel{background:#fff;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,.08);padding:16px;margin-bottom:16px}
.panel-head{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
.panel-actions{display:flex;gap:10px}
.btn{display:inline-block;padding:8px 14px;border-radius:6px;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:.18s}
.btn:hover{opacity:.92;transform:translateY(-1px)}
.primary{background:#2563eb;color:#fff}
.warning{background:#f59e0b;color:#fff}
.danger{background:#dc2626;color:#fff}

.badge{display:inline-block;padding:6px 10px;border-radius:6px;font-weight:600}
.ok{background:#d1f5d3;color:#166534}
.err{background:#fee2e2;color:#991b1b}

table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.08)}
th,td{border:1px solid #e5e7eb;padding:12px 14px;text-align:left;vertical-align:middle}
th{background:#1f2937;color:#fff}
tbody tr:nth-child(even){background:#f8fafc}
tr.group td{background:#eef2ff;color:#1e3a8a;font-weight:700}

td.actions{white-space:nowrap}
@media(max-width:900px){
    .panel-head{flex-direction:column;align-items:flex-start}
    td.actions form{display:block;margin-top:6px}
}
</style>
</head>
<body>

<div class="header">
<img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga RSHP">
</div>

<nav>
<div class="wrap">
    <a href="{{ route('admin.dashboard') }}">Home</a>
    <a href="{{ route('admin.data-master') }}" class="active" aria-current="page">Data Master</a>
    <a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a>
    <form method="POST" action="{{ route('logout') }}" style="margin-left:auto">
    @csrf
    <button type="submit">Logout</button>
    </form>
</div>
</nav>

<main class="main">
<div class="panel">
    <div class="panel-head">
    <h3>Data Ras Hewan</h3>

    @if (session('msg'))
        <span class="badge {{ session('type')==='success' ? 'ok' : 'err' }}">{{ session('msg') }}</span>
    @endif
    </div>

    <div class="panel-actions">
    <a class="btn primary" href="{{ route('admin.ras.create') }}">Tambah Ras</a>
    </div>
</div>

@php
    // Normalisasi data agar bisa handle berbagai bentuk input ($list / $daftarRas / format native)
    $source = $list ?? $daftarRas ?? [];
    $rows = [];

    foreach ($source as $item) {
    // Format native: ['obj'=>Ras, 'nama_jenis'=>string]
    if (is_array($item) && isset($item['obj'])) {
        $o = $item['obj'];
        $id = $o->idras_hewan ?? (method_exists($o,'get_idras_hewan') ? $o->get_idras_hewan() : ($o->get()['idras_hewan'] ?? null));
        $nama_ras = $o->nama_ras ?? (method_exists($o,'get_nama_ras') ? $o->get_nama_ras() : ($o->get()['nama_ras'] ?? null));
        $jenis_nama = $item['nama_jenis'] ?? ($o->jenis->nama_jenis_hewan ?? null);
    } else {
        // Object/array generik
        $id = $item->idras_hewan ?? $item['idras_hewan'] ?? $item->id ?? $item['id'] ?? null;
        $nama_ras = $item->nama_ras ?? $item['nama_ras'] ?? null;
        // ambil nama jenis via relasi / field alias
        $jenis_nama = $item->jenis->nama_jenis_hewan
        ?? $item['jenis_nama']
        ?? $item['nama_jenis']
        ?? $item->nama_jenis
        ?? $item->nama_jenis_hewan
        ?? null;
    }
    if ($id !== null && $nama_ras !== null) {
        $rows[] = ['id'=>$id, 'nama_ras'=>$nama_ras, 'jenis_nama'=>$jenis_nama ?? '—'];
    }
    }

    // Urutkan by Jenis, lalu Ras
    usort($rows, function($a,$b){
    return [$a['jenis_nama'],$a['nama_ras']] <=> [$b['jenis_nama'],$b['nama_ras']];
    });
@endphp

<table>
    <thead>
    <tr>
        <th style="width:260px">Jenis</th>
        <th>Ras</th>
        <th style="width:340px">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @php $current = null; @endphp

    @forelse($rows as $r)
        @if($r['jenis_nama'] !== $current)
        @php $current = $r['jenis_nama']; @endphp
        <tr class="group"><td colspan="3">{{ $current }}</td></tr>
        @endif
        <tr>
        <td class="small">{{ $current }}</td>
        <td>{{ $r['nama_ras'] }}</td>
        <td class="actions">
            <a class="btn warning" href="{{ route('admin.ras.edit', $r['id']) }}">Ubah</a>

            <form method="POST"
                action="{{ route('admin.ras.destroy', $r['id']) }}"
                style="display:inline-block"
                onsubmit="return confirm('Hapus ras ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn danger">Hapus</button>
            </form>
        </td>
        </tr>
    @empty
        <tr><td colspan="3" style="text-align:center"><em>Belum ada data</em></td></tr>
    @endforelse
    </tbody>
</table>
</main>

<footer style="background:#020381;color:#fff;text-align:center;padding:16px;margin-top:28px">
<h3>© {{ now()->year }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
<p>All rights reserved.</p>
</footer>

</body>
</html>
