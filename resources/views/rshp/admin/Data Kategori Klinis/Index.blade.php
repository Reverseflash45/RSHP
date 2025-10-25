<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Data Kategori Klinis</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f9f9f9;color:#333}

.header{background:#fff}
.header .wrap{max-width:1000px;margin:0 auto;padding:10px 16px;display:flex;align-items:center}
.brand img{height:72px}

.navbar{background:#f5b301}
.navbar .wrap{max-width:1000px;margin:0 auto;padding:12px 16px;display:flex;gap:16px;align-items:center}
.navbar a, .navbar button{color:#fff;font-weight:700;text-decoration:none;padding:6px 10px;border:none;background:transparent;cursor:pointer;border-radius:4px}
.navbar a:hover, .navbar button:hover{background:rgba(255,255,255,.2)}

.container{max-width:1000px;margin:28px auto;padding:0 16px}
.card{background:#fff;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,.1);padding:16px}
h2{margin-bottom:8px}

.alert{margin:12px 0;padding:10px;border-radius:6px;font-weight:600}
.alert.ok{background:#d1f5d3;color:#2d7a2f}
.alert.err{background:#f9d6d5;color:#a33a36}

.actions{margin:12px 0}
.btn{display:inline-block;padding:8px 14px;border-radius:6px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:.2s}
.primary{background:#2563eb;color:#fff}
.btn-warning{background:#f59e0b;color:#fff}
.btn-danger{background:#dc2626;color:#fff}
.btn:hover{opacity:.9;transform:translateY(-1px)}

.table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.1)}
.table th,.table td{border:1px solid #ddd;padding:12px 14px;text-align:left}
.table th{background:#1a1c1f;color:#fff}
.table tr:nth-child(even){background:#f6f6f6}

.footer{background:#020381;color:#fff;text-align:center;padding:16px;margin-top:28px}
.footer small{opacity:.9}
</style>
</head>
<body>

<div class="header">
<div class="wrap">
<div class="brand">
    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="UNAIR">
</div>
</div>
</div>

<nav class="navbar">
<div class="wrap">
<a href="{{ route('admin.dashboard') }}">Home</a>
<a href="{{ route('admin.data-master') }}" class="active" aria-current="page">Data Master</a>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</div>
</nav>

<div class="container">
<div class="card">
<h2>Data Kategori Klinis</h2>

@if (session('msg'))
    <div class="alert {{ session('type')==='success' ? 'ok' : 'err' }}">
    {{ session('msg') }}
    </div>
@endif

<div class="actions" style="margin:12px 0">
    <a class="btn primary" href="{{ route('admin.kategori-klinis.create') }}">+ Tambah</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th style="width:110px">ID</th>
        <th>Nama Kategori Klinis</th>
        <th style="width:360px">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @php
        // normalisasi agar tetap jalan kalau controller mengirim array/collection/paginator
        $rows = $list ?? $kk_list ?? [];
    @endphp

    @forelse ($rows as $row)
        @php
        $id   = $row->idkategori_klinis ?? $row['idkategori_klinis'] ?? $row->id ?? $row['id'] ?? null;
        $nama = $row->nama_kategori_klinis ?? $row['nama_kategori_klinis'] ?? $row->nama ?? $row['nama'] ?? null;
        @endphp
        <tr>
        <td>{{ $id }}</td>
        <td>{{ $nama }}</td>
        <td>
            <a class="btn btn-warning" href="{{ route('admin.kategori-klinis.edit', $id) }}">Ubah</a>

            <form method="POST"
                action="{{ route('admin.kategori-klinis.destroy', $id) }}"
                style="display:inline-block"
                onsubmit="return confirm('Hapus kategori klinis ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Hapus</button>
            </form>
        </td>
        </tr>
    @empty
        <tr><td colspan="3" style="text-align:center">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>

{{-- Pagination: aman tanpa method_exists --}}
@php
    $isPaginator =
    $rows instanceof \Illuminate\Contracts\Pagination\Paginator ||
    $rows instanceof \Illuminate\Pagination\LengthAwarePaginator ||
    $rows instanceof \Illuminate\Pagination\Paginator;
@endphp
@if($isPaginator)
    <div style="margin-top:14px">
    {{ $rows->links() }}
    </div>
@endif
</div>
</div>

<footer class="footer">
<div>© 2025 Rumah Sakit Hewan Pendidikan - Universitas Airlangga</div>
<small>All rights reserved.</small>
</footer>

</body>
</html>
