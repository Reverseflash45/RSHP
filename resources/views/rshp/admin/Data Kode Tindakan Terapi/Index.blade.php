<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Kode Tindakan Terapi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f9f9f9;color:#111827}

.header{background:#fff}
.header .wrap{max-width:1100px;margin:0 auto;padding:10px 16px;display:flex;align-items:center}
.brand img{height:72px}

.navbar{background:#f5b301}
.navbar .wrap{max-width:1100px;margin:0 auto;padding:12px 16px;display:flex;gap:16px;align-items:center}
.navbar a,.navbar button{color:#fff;font-weight:700;text-decoration:none;padding:6px 10px;border:none;background:transparent;cursor:pointer;border-radius:4px}
.navbar a:hover,.navbar button:hover{background:rgba(255,255,255,.2)}

.container{max-width:1100px;margin:28px auto;padding:0 16px}
.card{background:#fff;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,.08);padding:16px}

h2{margin-bottom:8px}

.alert{margin:12px 0;padding:10px;border-radius:6px;font-weight:600}
.ok{background:#d1f5d3;color:#2d7a2f}
.err{background:#f9d6d5;color:#a33a36}

.actions{margin:12px 0}
.btn{display:inline-block;padding:8px 14px;border-radius:6px;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:.18s}
.btn:hover{opacity:.92;transform:translateY(-1px)}
.primary{background:#2563eb;color:#fff}
.warning{background:#f59e0b;color:#fff}
.danger{background:#dc2626;color:#fff}

.table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.08)}
.table th,.table td{border:1px solid #e5e7eb;padding:12px 14px;text-align:left;vertical-align:top}
.table th{background:#1f2937;color:#fff}
.table tr:nth-child(even){background:#f8fafc}

.footer{background:#020381;color:#fff;text-align:center;padding:16px;margin-top:28px}
.footer small{opacity:.9}
</style>
</head>
<body>
{{-- Header --}}
<div class="header">
<div class="wrap">
    <div class="brand">
    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="UNAIR">
    </div>
</div>
</div>

{{-- Navbar --}}
<nav class="navbar">
<div class="wrap">
    <a href="{{ route('admin.dashboard') }}">Home</a>
    <a href="{{ route('admin.data-master') }}" class="active" aria-current="page">Data Master</a>
    <form method="POST" action="{{ route('logout') }}" style="margin-left:auto">
    @csrf
    <button type="submit">Logout</button>
    </form>
</div>
</nav>

<div class="container">
<div class="card">
    <h2>Data Kode Tindakan Terapi</h2>

    {{-- Flash message (opsional) --}}
    @if (session('msg'))
    <div class="alert {{ session('type')==='success' ? 'ok' : 'err' }}">
        {{ session('msg') }}
    </div>
    @endif

    <div class="actions">
    <a class="btn primary" href="{{ route('admin.kode-tindakan.create') }}">+ Tambah</a>
    </div>

    <table class="table">
    <thead>
        <tr>
        <th style="width:80px">ID</th>
        <th style="width:140px">Kode</th>
        <th>Deskripsi Tindakan</th>
        <th style="width:220px">Kategori</th>
        <th style="width:240px">Kategori Klinis</th>
        <th style="width:220px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        // Normalisasi sumber data: boleh $list atau $kt_list
        $rows = $list ?? $kt_list ?? [];

        // Pastikan map tersedia sebagai array
        $mapKat  = isset($mapKat)  ? $mapKat  : [];
        $mapKlin = isset($mapKlin) ? $mapKlin : [];
        @endphp

        @forelse ($rows as $row)
        @php
            // Ambil data aman (support Eloquent, stdClass, atau object lama)
            $id   = $row->id            ?? $row['id']            ?? (method_exists($row,'get_id') ? $row->get_id() : null);
            $kode = $row->kode          ?? $row['kode']          ?? (method_exists($row,'get_kode') ? $row->get_kode() : null);
            $desk = $row->deskripsi     ?? $row['deskripsi']     ?? (method_exists($row,'get_deskripsi') ? $row->get_deskripsi() : null);
            $idk  = $row->idkategori    ?? $row['idkategori']    ?? (method_exists($row,'get_idkategori') ? $row->get_idkategori() : null);
            $idkk = $row->idkategori_klinis ?? $row['idkategori_klinis'] ?? (method_exists($row,'get_idkategori_klinis') ? $row->get_idkategori_klinis() : null);

            $namaKat  = $mapKat[$idk]  ?? (string) $idk;
            $namaKlin = $mapKlin[$idkk] ?? (string) $idkk;
        @endphp

        <tr>
            <td>{{ $id }}</td>
            <td>{{ $kode }}</td>
            <td>{{ $desk }}</td>
            <td>{{ $namaKat }}</td>
            <td>{{ $namaKlin }}</td>
            <td>
            <a class="btn warning" href="{{ route('admin.kode-tindakan.edit', $id) }}">Ubah</a>

            <form method="POST"
                    action="{{ route('admin.kode-tindakan.destroy', $id) }}"
                    style="display:inline-block"
                    onsubmit="return confirm('Hapus data ini?')">
                @csrf
                @method('DELETE')
                <button class="btn danger" type="submit">Hapus</button>
            </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center">Belum ada data</td></tr>
        @endforelse
    </tbody>
    </table>

    {{-- Pagination jika $rows adalah LengthAwarePaginator/Collection with links --}}
    @if (is_object($rows) && method_exists($rows, 'links'))
    <div style="margin-top:14px">{{ $rows->links() }}</div>
    @endif
</div>
</div>

<footer class="footer">
<div>© {{ now()->year }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</div>
<small>All rights reserved.</small>
</footer>
</body>
</html>
