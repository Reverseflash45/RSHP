<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Data Kategori</title>
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
<h2>Data Kategori</h2>

@if (session('msg'))
    <div class="alert {{ session('type')==='success' ? 'ok' : 'err' }}">
    {{ session('msg') }}
    </div>
@endif

<div class="actions">
    <a class="btn primary" href="{{ route('admin.kategori.create') }}">+ Tambah</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th style="width:120px">ID</th>
        <th>Nama Kategori</th>
        <th style="width:320px">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($list as $k)
        <tr>
        <td>{{ $k->idkategori }}</td>
        <td>{{ $k->nama_kategori }}</td>
        <td>
            <a class="btn btn-warning" href="{{ route('admin.kategori.edit', $k->idkategori) }}">Ubah</a>

            <form method="POST"
                action="{{ route('admin.kategori.destroy', $k->idkategori) }}"
                style="display:inline"
                onsubmit="return confirm('Hapus data ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </td>
        </tr>
    @empty
        <tr>
        <td colspan="3" style="text-align:center"><em>Belum ada data.</em></td>
        </tr>
    @endforelse
    </tbody>
</table>

{{-- Pagination aman: hanya tampil kalau $list adalah paginator --}}
@php
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;
@endphp
@if(isset($list) && ($list instanceof Paginator || $list instanceof LengthAwarePaginator))
    <div style="margin-top:14px">
    {{ $list->links() }}
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
