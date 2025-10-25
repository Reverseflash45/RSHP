<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Data Pemilik (Admin)</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f9f9f9;color:#333}

.header{background:#fff;text-align:center;padding:10px}
.header img{height:72px}

nav{background:#f5b301}
nav .wrap{max-width:1100px;margin:0 auto;padding:12px 16px;display:flex;gap:16px;align-items:center}
nav a, nav button{color:#fff;font-weight:700;text-decoration:none;padding:6px 10px;border:none;background:transparent;cursor:pointer;border-radius:4px}
nav a:hover, nav button:hover{background:rgba(255,255,255,.2)}

.wrap{max-width:1100px;margin:28px auto;padding:0 16px}

h2{margin-bottom:8px}

.msg{margin:12px 0;padding:10px;border-radius:6px;font-weight:600}
.ok{background:#d1f5d3;color:#2d7a2f}
.err{background:#f9d6d5;color:#a33a36}

.card{background:#fff;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,.08);padding:16px;margin:12px 0}
.card h3{margin:0 0 10px;color:#0c4a6e}

.row{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}
.row label{display:block;font-size:.85rem;margin-bottom:4px;color:#334155}
.row input{width:100%;padding:9px 10px;border:1px solid #cbd5e1;border-radius:6px}

.actions{margin-top:12px;display:flex;gap:10px}
.btn{display:inline-block;padding:9px 14px;border-radius:6px;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:.2s}
.btn:hover{opacity:.92;transform:translateY(-1px)}
.primary{background:#2563eb;color:#fff}
.ghost{background:#e2e8f0;color:#0f172a}

table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.08)}
th,td{border:1px solid #e5e7eb;padding:12px 14px;text-align:left;vertical-align:middle}
th{background:#1f2937;color:#fff}
tbody tr:nth-child(even){background:#f8fafc}
tbody tr form{display:grid;grid-template-columns:2fr 2fr 1.4fr 2.2fr auto;gap:10px;align-items:center}
tbody input{width:100%;padding:8px 10px;border:1px solid #cbd5e1;border-radius:6px}
tbody .btn.primary{padding:8px 12px}

footer{background:#020381;color:#fff;text-align:center;padding:16px;margin-top:28px}
@media(max-width:900px){
    .row{grid-template-columns:1fr}
    tbody tr form{grid-template-columns:1fr}
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
    <a href="{{ route('admin.data-master') }}">Data Master</a>
    <form method="POST" action="{{ route('logout') }}" style="margin-left:auto">
    @csrf
    <button type="submit">Logout</button>
    </form>
</div>
</nav>

<div class="wrap">
<h2>Master Data Pemilik</h2>

@if (session('msg'))
    <div class="msg {{ session('type')==='success' ? 'ok' : 'err' }}">{{ session('msg') }}</div>
@endif

{{-- Form Tambah Pemilik --}}
<div class="card">
    <h3>Tambah Pemilik</h3>
    <form method="POST" action="{{ route('admin.pemilik.store') }}">
    @csrf
    <div class="row">
        <div>
        <label>Nama</label>
        <input name="nama" value="{{ old('nama') }}" required>
        @error('nama') <div class="msg err" style="margin-top:6px">{{ $message }}</div> @enderror
        </div>
        <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="msg err" style="margin-top:6px">{{ $message }}</div> @enderror
        </div>
        <div>
        <label>Password</label>
        <input type="password" name="password" minlength="6" required>
        @error('password') <div class="msg err" style="margin-top:6px">{{ $message }}</div> @enderror
        </div>
        <div>
        <label>No. WA</label>
        <input name="no_wa" value="{{ old('no_wa') }}" required>
        @error('no_wa') <div class="msg err" style="margin-top:6px">{{ $message }}</div> @enderror
        </div>
        <div>
        <label>Alamat</label>
        <input name="alamat" value="{{ old('alamat') }}" required>
        @error('alamat') <div class="msg err" style="margin-top:6px">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="actions">
        <button class="btn primary" type="submit">+ Tambah</button>
        <button class="btn ghost" type="reset">Reset</button>
    </div>
    </form>
</div>

{{-- Tabel List + Edit Inline --}}
<table>
    <thead>
    <tr>
        <th style="width:120px">ID Pemilik</th>
        <th>Baris Data (Edit Inline)</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($list as $row)
        <tr>
        <td>#{{ $row->idpemilik ?? $row['idpemilik'] }}</td>
        <td>
            <form method="POST" action="{{ route('admin.pemilik.update', $row->idpemilik ?? $row['idpemilik']) }}">
            @csrf
            @method('PUT')
            <input type="text"  name="nama"   value="{{ old('nama_'.$loop->index, $row->nama ?? $row['nama']) }}"   required>
            <input type="email" name="email"  value="{{ old('email_'.$loop->index, $row->email ?? $row['email']) }}" required>
            <input type="text"  name="no_wa"  value="{{ old('no_wa_'.$loop->index, $row->no_wa ?? $row['no_wa'] ?? '') }}">
            <input type="text"  name="alamat" value="{{ old('alamat_'.$loop->index, $row->alamat ?? $row['alamat'] ?? '') }}">
            <button type="submit" class="btn primary">Simpan</button>
            </form>
        </td>
        </tr>
    @empty
        <tr><td colspan="2"><em>Tidak ada data.</em></td></tr>
    @endforelse
    </tbody>
</table>

@if(method_exists($list, 'links'))
    <div style="margin-top:14px">{{ $list->links() }}</div>
@endif
</div>

<footer>
<h3>© {{ now()->year }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
<p>All rights reserved.</p>
</footer>

</body>
</html>
