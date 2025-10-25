<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jenis Hewan - RSHP Universitas Airlangga</title>

{{-- Inline CSS dari versi native --}}
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f9f9f9;
    color: #333;
}

/* Header */
.header {
    background: #fff;
    padding: 10px;
    text-align: center;
}

.header img {
    height: 80px;
}

/* Navigasi */
nav {
    display: flex;
    justify-content: center;
    gap: 30px;
    padding: 15px 0;
    background-color: #f5b301;
}

nav a {
    text-decoration: none;
    padding: 5px 10px;
    color: white;
    font-weight: bold;
    border-radius: 4px;
    transition: background 0.2s ease;
}

nav a:hover {
    background: rgba(255, 255, 255, 0.2);
}

nav form {
    display: inline-block;
}

nav button {
    background: #dc2626;
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}

nav button:hover {
    opacity: 0.9;
}

/* Main */
.main {
    max-width: 900px;
    margin: 30px auto;
    padding: 0 20px;
}

.panel {
    background: #fff;
    padding: 15px 20px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    margin-bottom: 20px;
}

.panel-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.panel h3 {
    font-size: 20px;
}

.panel-actions {
    margin-top: 10px;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
    text-decoration: none;
}

.btn.primary {
    background-color: #2563eb;
    color: #fff;
}

.btn.warning {
    background-color: #f59e0b;
    color: #fff;
}

.btn.danger {
    background-color: #dc2626;
    color: #fff;
}

.btn:hover {
    opacity: .9;
    transform: translateY(-2px);
    box-shadow: 0 3px 6px rgba(0, 0, 0, .12);
}

/* Badge notif */
.badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.9em;
}

.badge.ok {
    background: #d1f5d3;
    color: #2d7a2f;
}

.badge.err {
    background: #f9d6d5;
    color: #a33a36;
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    margin-top: 10px;
}

th, td {
    border: 1px solid #ccc;
    padding: 12px 15px;
    text-align: left;
}

th {
    background-color: #1a1c1f;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

td.actions {
    white-space: nowrap;
}

td.actions form {
    display: inline-block;
}

/* Footer */
footer {
    background-color: #020381;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 30px;
    font-size: 14px;
    line-height: 1.5;
}

footer h3 {
    margin-bottom: 10px;
}
</style>
</head>
<body>

{{-- Header --}}
<div class="header">
<img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga RSHP">
</div>

{{-- Navigasi --}}
<nav>
<a href="{{ route('admin.dashboard') }}">Home</a>
<a href="{{ route('admin.data-master') }}" class="active" aria-current="page">Data Master</a>
<a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a>
<a href="{{ route('admin.pemilik.index') }}">Pemilik</a>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</nav>

{{-- Konten utama --}}
<main class="main">
<div class="panel">
    <div class="panel-head">
    <h3>Data Jenis Hewan</h3>
    @if(session('msg'))
        <span class="badge {{ session('type') === 'success' ? 'ok' : 'err' }}">
        {{ session('msg') }}
        </span>
    @endif
    </div>

    <div class="panel-actions">
    <a class="btn primary" href="{{ route('admin.jenis-hewan.create') }}">Tambah Jenis</a>
    </div>
</div>

<table>
    <thead>
    <tr>
        <th style="width:90px;">ID</th>
        <th>Nama Jenis</th>
        <th style="width:220px;">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @forelse($list as $j)
        <tr>
        <td>{{ $j->idjenis_hewan }}</td>
        <td>{{ $j->nama_jenis_hewan }}</td>
        <td class="actions">
            <a class="btn warning" href="{{ route('admin.jenis-hewan.edit', $j->idjenis_hewan) }}">Ubah</a>

            <form method="POST" action="{{ route('admin.jenis-hewan.destroy', $j->idjenis_hewan) }}" onsubmit="return confirm('Hapus data ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn danger">Hapus</button>
            </form>
        </td>
        </tr>
    @empty
        <tr><td colspan="3"><em>Belum ada data</em></td></tr>
    @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div style="margin-top:16px;">
    {{ $list->links() }}
</div>
</main>

{{-- Footer --}}
<footer>
<h3>© 2025 Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
<p>All rights reserved.</p>
</footer>

</body>
</html>
