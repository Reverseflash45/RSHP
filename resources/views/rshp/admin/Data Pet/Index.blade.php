<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Data Pet</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f9f9f9;color:#333}

.header{background:#fff}
.header .wrap{max-width:1100px;margin:0 auto;padding:10px 16px;display:flex;align-items:center}
.brand img{height:72px}

.navbar{background:#f5b301}
.navbar .wrap{max-width:1100px;margin:0 auto;padding:12px 16px;display:flex;gap:16px;align-items:center}
.navbar a,.navbar button{color:#fff;font-weight:700;text-decoration:none;padding:6px 10px;border:none;background:transparent;cursor:pointer;border-radius:4px}
.navbar a:hover,.navbar button:hover{background:rgba(255,255,255,.2)}

.container{max-width:1100px;margin:28px auto;padding:0 16px}
.card{background:#fff;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,.1);padding:16px}

h2{margin-bottom:8px}

.alert{margin:12px 0;padding:10px;border-radius:6px;font-weight:600}
.ok{background:#d1f5d3;color:#2d7a2f}
.err{background:#f9d6d5;color:#a33a36}

.actions{margin:12px 0}
.btn{display:inline-block;padding:8px 14px;border-radius:6px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:.2s}
.btn:hover{opacity:.9;transform:translateY(-1px)}
.primary{background:#2563eb;color:#fff}
.danger{background:#dc2626;color:#fff}
.warning{background:#f59e0b;color:#fff}

.table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.1)}
.table th,.table td{border:1px solid #ddd;padding:12px 14px;text-align:left;vertical-align:top}
.table th{background:#1a1c1f;color:#fff}
.table tr:nth-child(even){background:#f6f6f6}

.footer{background:#020381;color:#fff;text-align:center;padding:16px;margin-top:28px}
.footer small{opacity:.9}

@media (max-width: 900px){
.table th:nth-child(3), .table td:nth-child(3),
.table th:nth-child(4), .table td:nth-child(4),
.table th:nth-child(5), .table td:nth-child(5){display:block;width:auto}
}
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
<h2>Data Pet</h2>

{{-- Flash message dari controller --}}
@if(session('msg'))
<div class="alert {{ session('type')==='success' ? 'ok' : 'err' }}">
    {{ session('msg') }}
</div>
@endif

<div class="actions">
<a class="btn primary" href="{{ route('admin.pet.create') }}">+ Tambah Pet</a>
</div>

<table class="table" style="margin-top:14px">
<thead>
    <tr>
    <th style="width:80px">ID</th>
    <th>Nama Pet</th>
    <th>Pemilik</th>
    <th>Ras</th>
    <th>Jenis Hewan</th>
    <th style="width:180px">Tanggal Lahir</th>
    <th style="width:260px">Aksi</th>
    </tr>
</thead>
<tbody>
    @forelse($rows as $p)
    <tr>
        <td>{{ $p->idpet ?? '-' }}</td>
        <td>{{ $p->nama ?? '-' }}</td>
        <td>{{ $p->pemilik->nama ?? '-' }}</td>
        <td>{{ $p->ras->nama_ras ?? '-' }}</td>
        <td>{{ $p->jenis->nama_jenis ?? '-' }}</td>
        <td>{{ $p->tanggal_lahir ?? '-' }}</td>
        <td>
        <a class="btn warning" href="{{ route('admin.pet.edit', $p->idpet ?? 0) }}">Edit</a>

        <form method="POST"
                action="{{ route('admin.pet.destroy', $p->idpet ?? 0) }}"
                style="display:inline-block"
                onsubmit="return confirm('Hapus data ini?')">
            @csrf
            @method('DELETE')
            <button class="btn danger" type="submit">Hapus</button>
        </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" style="text-align:center"><em>Belum ada data.</em></td>
    </tr>
    @endforelse
</tbody>
</table>

{{-- Pagination aman --}}
@php
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;
@endphp

@if(isset($rows) && ($rows instanceof Paginator || $rows instanceof LengthAwarePaginator))
    <div style="margin-top:14px">
    {{ $rows->links() }}
    </div>
@endif

</div>
</div>

<footer class="footer">
<div>© {{ now()->year }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</div>
<small>All rights reserved.</small>
</footer>

</body>
</html>
